<?php

session_start();

if(isset($_SESSION["user_login"])) {
    echo "Ose su login cheiiii!";
    echo "<meta http-equiv='refresh' content='1; url=index.php'>";
    die();
}

require_once 'config/koneksi.php';

if ( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $cekadmin = mysqli_query($conn, "SELECT * FROM admin_tb WHERE
      username = '$username' AND password = '$password'
    ");

    if( $hasil = mysqli_num_rows($cekadmin) > 0 ) {
        $_SESSION["user_login"] = $username;
        echo "Login berhasil! Tunggu sebentar..";
        echo "<meta http-equiv='refresh' content='2; url=index.php'>";
        die();
    } else {
        echo "<script>alert('User tidak ditemukan');</script>";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">
  <title>Login | Admin</title>
</head>
<body class="w-silver">



<div class="card my-auto mx-auto" style="width: 18rem;">
   <div class="card-body">
     <h5 class="card-title">Login</h5>
     <form action="" method="POST">
       <div class="form-group">
         <label for="username">Username</label>
         <input type="text" class="form-control" id="username" name="username" required>
         <small id="emailHelp" class="form-text text-muted">Nama Pengguna (Admin)</small>
       </div>
       <div class="form-group">
         <label for="password">Password</label>
         <input type="password" class="form-control" id="password" name="password" required>
         <small id="emailHelp" class="form-text text-muted">Kata Sandi</small>
       </div>
       <button type="submit" name="login" class="btn btn-primary">Login</button>
     </form>
   </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>