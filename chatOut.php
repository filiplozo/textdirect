<?php
include_once("db_connect.php");
$connection = mysqli_connect($host , $username , $password , $db);
if(isset($_GET['id'])){
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    $sql = mysqli_query($connection , "UPDATE users SET activity='0' WHERE id='$id'")or die(mysqli_error());
    exit();
}
?>
