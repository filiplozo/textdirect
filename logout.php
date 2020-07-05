<?php
session_start();
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    include_once("db_connect.php");
    $connection = mysqli_connect($host , $username , $password , $db);
    $sql = mysqli_query($connection ,"UPDATE users SET activity='0' WHERE id='$id'")or die(mysqli_error());
}
session_destroy();
header("location: login.php"); //returning to previous page
exit();
?>
