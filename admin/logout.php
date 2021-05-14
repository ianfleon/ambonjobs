<?php
session_start();
$_SESSION["user_login"] ="";
unset($_SESSION['user_login']);
session_destroy();
echo "Logout! Ingatang..";
echo "<meta http-equiv='refresh' content='2; url=login.php'>";
die();
