<?php
$output = "";
include_once("db_connect.php");
$connection = mysqli_connect($host , $username , $password , $db);
$sql = mysqli_query($connection, " SELECT * FROM chatbox ORDER BY postID ASC LIMIT 20"); //ispis zadnjih dvadeset poruka
while($row = mysqli_fetch_array($sql)) {
    $chat = $row['body'];
    $username = $row['username'];
    $output = '<p id="box"><span id="username">' . $username . ':</span> ' . $chat . '</p>'; //promenljiva koja sadrzi username korisnika i poruku koju je poslao
    echo "$output";
}
?>