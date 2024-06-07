<?php
include("./DBconnection/connect.php");




if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $query = "SELECT filename FROM login WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $profile_picture_row = mysqli_fetch_assoc($result);

        if ($profile_picture_row) {
            $profile_picture = $profile_picture_row['filename'];
            // echo "Profile Picture Filename: " . $profile_picture;
            // You can use $profile_picture in your HTML or wherever you need
        } else {
            echo "Profile Picture not found";
        }
    } else {
        echo "Error in executing query: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "User not logged in";
}

mysqli_close($conn);
?>
