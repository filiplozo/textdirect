<?php

$host = "localhost";
$username = "root";
$password = "";
$db= "vezba";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>