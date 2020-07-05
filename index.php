<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once("db_connect.php");

    $id = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
    $connection = mysqli_connect($host , $username , $password , $db);
    $sql = mysqli_query($connection ,"SELECT username FROM users WHERE id='$id'");
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        $sqlLog = mysqli_query($connection ,"UPDATE users SET activity='1' WHERE id='$id'") or die(mysqli_error()); //confirming that a user is in the chat
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

    <style type="text/css">
        body{
            background:moccasin;
            padding-left:40px;
        }

        #viewChats{
            padding:12px;
            overflow:auto;
            border:#333 1px solid;
            border-radius:6px;
            width:337px;
            height:300px;
            background-color: white;
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

        #chatButton{
            float:left;
        }
        #nu{
            color:black;
        }

    </style>
</head>

<body onLoad='window.setTimeout("view_count()",2000);'>

<div id="nu"></div>
<a href="logout.php">Log out</a>
<div id="viewChats"></div>
<br>
<input type="text" name="chat" id="chat" size="48">
<input type="image" id="chatButton" src="104603_send-button-png.jpg" width="67" height="51" onClick="post_chat();">
<div id="status"></div>
<script type="text/javascript" src="chat.js"></script>
<script type="text/javascript">view_count();</script>
<script type="text/javascript">list_chats();</script>

</body>
</html>

