<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Check if the user is logged in
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    // Now $userId contains the user ID, and you can use it as needed.
} else {
    // User is not logged in. Redirect or handle accordingly.
}
?>