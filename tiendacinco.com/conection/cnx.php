<?php
$hostname_cnx = "localhost";
$database_cnx = "pagina_web";

$username_cnx = "root";
$password_cnx = "";

$cnx = mysqli_connect($hostname_cnx, $username_cnx, $password_cnx, $database_cnx) or
 trigger_error(mysqli_connect_errno(),E_USER_ERROR);
 mysqli_set_charset($cnx, "utf8");
 ?>
