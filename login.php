<?php
session_start();
include("db_connect.php");
$msg="Welcome User";
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $email);

    if ((!$email) || (!$pass)) {
        $msg = '<span style="color:#F00;">  Please fill in all fields</span>';
    }else { //ako je sve uneto, izvrsava se ovaj deo
        $connection = mysqli_connect($host , $username , $password , $db);
        $sql = mysqli_query($connection , "SELECT * FROM users WHERE email = '$email' AND password = '$pass' LIMIT 1")or die(mysqli_error());
        $num_rows = mysqli_num_rows($sql);
        if($num_rows > 0) {
            while($row = mysqli_fetch_array($sql)) {
                $id = $row['id'];
                $email = $row['email'];
                $pass = $row['password'];
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $pass;
                $_SESSION['id'] = $id;

                mysqli_query($connection, "UPDATE users SET activity='y', last_login=now() WHERE email = '$email' AND password = '$pass' LIMIT 1")or die(mysqli_error());
                header("Location: index.php");
                exit();
            }

        }else {
            $msg = '<span style="color:#F00;">The email or password is not correct!</span>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style type="text/css">
        body{
            background:moccasin;
            text-align:center;
            color:black;
            font-size:x-large;

        }
    </style>
</head>
<body>
<div class="loginForm">
    <form action="login.php" method="post">
        <strong>Log in</strong>
        <br />
        <strong><?php echo $msg; ?> </strong>
        <br />
        <br />
        <strong>Email</strong>
        <br />
        <input type="text" name="email">
        <br />
        <strong>Password</strong>
        <br />
        <input type="password" name="password">
        <br />
        <br />
        <input id="button" type="submit" name="submit" value="Log In">
    </form>
</div>
</body>
</html>