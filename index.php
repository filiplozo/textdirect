<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once("db_connect.php");

    $id = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
    $connection = mysqli_connect($host , $username , $password , $db);
    $sql = mysqli_query($connection ,"SELECT username FROM users WHERE idUsers='$id'");
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        $sqlLog = mysqli_query($connection ,"UPDATE users SET activity='y' WHERE idUsers='$id'") or die(mysqli_error()); //confirming that a user is in the chat
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript">view_count();</script>
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
        #wlc{
            color:red;
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
<p>
    <a href="logout.php" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-log-out"></span> Log out
    </a>
</p>
<br>
<div id="viewChats"></div>
<br>
<input type="text" name="chat" id="chat" size="48">
<input type="submit" value="Send" id="chatButton">

<div id="status"></div>


</body>
</html>

