<?php
require_once('../conection/cnx.php');

$id = intval($_GET['id']);
$query = "DELETE FROM productos WHERE id=$id";
mysqli_query($cnx, $query) or die(mysqli_error($cnx));

header("Location: controlpanel.php");
exit;
?>
