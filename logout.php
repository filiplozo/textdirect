<?php
session_start();
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    include_once("db_connect.php");
    $sql = mysqli_query("UPDATE users SET activity='n' WHERE idUsers='$id'")or die(mysqli_error());
}
session_destroy();
header("location: login.php"); //returning to previous page
exit();
?>
