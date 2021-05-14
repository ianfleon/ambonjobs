<?php

session_start();

if(!isset($_SESSION["user_login"])) {
    echo "Login do he!";
    echo "<meta http-equiv='refresh' content='1; url=login.php'>";
    die();
}

require_once 'config/fun_exec.php';

if( isset($_GET["t"]) ) {
	$id = $_GET["t"];
	$query = mysqli_query($conn, "DELETE FROM tempat_tb WHERE id_tempat = '$id'");
	echo "Data tempat sedang dihapus..";
	echo "<meta http-equiv='refresh' content='3; url=index.php'>";
} elseif ( isset($_GET["l"]) ) {
	$id = $_GET["l"];
	$query = mysqli_query($conn, "DELETE FROM loker_tb WHERE id_loker = '$id'");
	echo "Data loker sedang dihapus..";
	echo "<meta http-equiv='refresh' content='3; url=lowongan.php?id_t="
	. $_GET["id_t"] . "&&" . "n_tempat=" . $_GET["n_t"] . "'>";
}