<?php
session_start();
include_once("db_connect.php");
$connection = mysqli_connect($host , $username , $password , $db);

if(isset($_SESSION['id'])){
    debug_to_console("Test");
    $id = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
    $sql = mysqli_query($connection, "SELECT * FROM users WHERE id='$id'");
    while($row = mysqli_fetch_array($sql)){
        $userID = $row['id'];
        $username = $row['username'];
    }
}
if(isset($_POST['chat'])){
    $chat = $_POST['chat'];
    if(!$chat){
        echo "Please type something";
        exit();
    }
    $chat = mysqli_real_escape_string($connection,$_POST['chat']);
    $chat = strip_tags($chat);
    $sql = mysqli_query($connection, "INSERT INTO chatbox (userID, body, username) VALUES ('$userID','$chat', '$username')") or die(mysqli_error());
    exit();
}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
