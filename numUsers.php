<?php
if(isset($_GET["t"])){
    include_once("db_connect.php");
    $connection = mysqli_connect($host , $username , $password , $db);
    $sql = mysqli_query($connection , "SELECT activity FROM users WHERE activity='1'")or die(mysqli_error());
    $num_rows = mysqli_num_rows($sql);
    if($num_rows > 1){ //ako je promenljiva sql vratila informaciju da ima vise od jednog korisnika na chatu
        $a = $num_rows - 1;
        echo "You and $a other user(s) are currently in the chat";
    }else if($num_rows == 1){ //ako je korisnik jedini na chatu
        echo "You are the only person in the chat";
    }else{
        echo "There was an error, please log in again"; //u slucaju neke greske
        exit();
    }
}
?>
