<?php

$show_error = "false";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "dbconnect.php";

    $user_email = $_POST['signupEmail'];
    $pass = $_POST['singuppassword'];
    $cpass = $_POST['signupcpassword'];

    // this email exsit
    $existsql = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($con, $existsql);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $show_error = "Email alery in use";
    } else {
        if ($pass == $cpass) {
            $harsh = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `date`) VALUES ('$user_email', '$harsh', current_timestamp())";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $show_error = true;
                header("location: /FORUM/index.php?signupsuccess=true");
                exit();
            }
        } else {
            $show_error = "Password do not match";

        }

    }
    header("location: /forum/index.php?signupsuccess=fasle&error=$show_error");

}


?>