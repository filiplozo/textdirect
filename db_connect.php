<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "schema";

$connection = mysqli_connect("$host", "$username", "$password") or die(mysqli_error());
mysqli_select_db("$db",$connection) or die(mysqli_error());

?>
