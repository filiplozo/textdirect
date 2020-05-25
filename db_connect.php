<?php

$host = "localhost";
$username = "root";
$password = "";
$db= "textdirect";

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>