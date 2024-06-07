<?php
session_start();
include("../DBconnection/connect.php");
include("dataValidation.php");

if (isset($_POST['login'])) {
    $email = data_valid($_POST["email"]);
    $pwd = data_valid($_POST["pwd"]);

    $query = "SELECT * FROM login WHERE email='$email' AND password='$pwd'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] === $email && $row['password'] === $pwd) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['id'] = $row['id'];
            echo '<script type="text/javascript">'; 
            echo 'window.location.href="../index.php";'; 
            echo '</script>';
            $_SESSION['user_logged_in'] = true;
            exit();
        } else {
            echo '<script type="text/javascript">'; 
            echo 'window.location.href="../new-login.php?error=Incorrect Username or Password";'; 
            echo '</script>';
        }
    } else {
            echo '<script type="text/javascript">'; 
            echo 'window.location.href="../new-login.php?error=Incorrect Username or Password";'; 
            echo '</script>';
    }
} else {
    echo '<script type="text/javascript">'; 
    echo 'window.location.href="../index.php";'; 
    echo '</script>';
}
