<?php
session_start();
require("db_connect.php");
$msg="";
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $email = mysqli_real_escape_string($email);
    $pass = md5($pass);
    $email = stripslashes($email);
    $email = strip_tags($email);

    if ((!$email) || (!$pass)) {
        $msg = '<span style="color:#F00;">ERROR : Please fill in all fields</span>';
    }else { //ako je sve uneto, izvrsava se ovaj deo
        $sql = mysqli_query("SELECT * FROM users WHERE email = '$email' AND password = '$pass' LIMIT 1")or die(mysqli_error());
        $num_rows = mysqli_num_rows($sql);
        if($num_rows > 0) {
            while($row = mysqli_fetch_array($sql)) {
                $id = $row['id'];
                $email = $row['email'];
                $pass = $row['password'];
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $pass;
                $_SESSION['id'] = $id;

                mysqli_query("UPDATE users SET activity='y', last_login=now() WHERE email = '$email' AND password = '$pass' LIMIT 1")or die(mysqli_error());
                header("Location: index.php");
                exit();
            }

        }else {
            $msg = '<span style="color:#F00;">ERROR : That email and password combination does not exist</span>';
        }
    }
}
?>
