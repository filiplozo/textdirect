<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once("db_connect.php");
    $id = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
    $sql = mysqli_query("SELECT username FROM users WHERE idUsers='$id'");
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        $sqlLog = mysqli_query("UPDATE users SET activity='y' WHERE idUsers='$id'") or die(mysqli_error()); //confirming that a user is in the chat
        while ($row = mysqli_fetch_array($sql)) {
            $username = $row['username'];
            $welcome = "Hello $username"; //message says hello to the user
        }
    } else {
        echo "Sorry, you must be logged in to chat"; //message if we are not logged in and trying to send something
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>TextDirect</title>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript">view_count();</script>
    <style type="text/css">
        body{
            background:white;
            text-align:center;
            padding-left:40px;
        }
        #viewChats{
            padding:12px;
            overflow:auto;
            border:#333 1px solid;
            border-radius:6px;
            width:337px;
            height:300px;
        }
        #username{
            color:#F00;
        }
        #chat{
            text-align:left;
            color:blue;
            padding-top: 6px;
            float:left;
            height:40px;
            width:300px;
            font-weight:bold;
        }
        #status{
            color:green;
        }
        #wlc{
            color:red;
        }
        #box{
            text-align:left;
            color:yellow;
        }
        #chatButton{
            float:left;
        }
        #nu{
            color:black;
        }
    </style>
</head>
<body>
<h2 id="wlc"></h2>
<div id="nu"></div>
<a href="logout.php">Log out</a>
<div id="viewChats"></div>
<br>
<input type="text" name="chat" id="chat" size="48">
<input type="submit" id="chatButton">
<div id="status"></div>

</body>
</html>

