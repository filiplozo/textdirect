<?php
session_start();
include_once("db_connect.php");
if(isset($_SESSION['id'])){
    $id = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
    $sql = mysqli_query("SELECT username FROM users WHERE idUsers='$id'");
    while($row = mysqli_fetch_array($sql)){
        $uname = $row['username'];
    }
}
if(isset($_POST['chat'])){
    $chat = $_POST['chat'];
    if(!$chat){
        echo "Please type something";
        exit();
    }
    $chat = mysqli_real_escape_string($chat);
    $chat = strip_tags($chat);
    $sql = mysqli_query("INSERT INTO chatbox (body, username) VALUES ('$chat', '$uname')") or die(mysqli_error());
    exit();
}
?>
