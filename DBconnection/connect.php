<?php

$servername = "localhost";
$username = "root";
$pwd = "";
$db = "inselto.co";

$conn = mysqli_connect($servername, $username, $pwd, $db);

// Check connection
if (!$conn) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>