<?php
include('../DBconnection/connect.php');
$statusMsg = '';
$targetDirWorkImg = "uploads/";
$targetDir = "../profilePic/";

if (isset($_POST['update_btn'])) {
    $user_id = $_POST["user_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $jobRole = $_POST["jobRole"];
    $aboutme = $_POST["aboutme"];
    $ExpYears = $_POST["ExpYears"];
    $WorkDays = implode(',', $_POST["WorkDays"]); // Convert array to comma-separated string
    $timeRange = $_POST["timeRange"];
    $workAreas = $_POST["workAreas"];
    $timeCall = $_POST["timeCall"];
    $telNo = $_POST["telNo"];

    // Update user details in login table
    $updateLoginQuery = "UPDATE login SET firstName=?, lastName=?, telNo=? WHERE id=?";
    $stmtLogin = mysqli_prepare($conn, $updateLoginQuery);
    mysqli_stmt_bind_param($stmtLogin, "sssi", $fname, $lname, $telNo, $user_id);
    $updateLoginResult = mysqli_stmt_execute($stmtLogin);

    // Insert or update service details
    $updateServiceQuery = "INSERT INTO service (user_id, jobRole, aboutme, ExpYears, WorkDays, timeRange, workAreas, timeCall) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
    ON DUPLICATE KEY UPDATE 
        jobRole = VALUES(jobRole), 
        aboutme = VALUES(aboutme), 
        ExpYears = VALUES(ExpYears), 
        WorkDays = VALUES(WorkDays), 
        timeRange = VALUES(timeRange), 
        workAreas = VALUES(workAreas), 
        timeCall = VALUES(timeCall)";

$stmtService = mysqli_prepare($conn, $updateServiceQuery);
mysqli_stmt_bind_param($stmtService, "isssssss", $user_id, $jobRole, $aboutme, $ExpYears, $WorkDays, $timeRange, $workAreas, $timeCall);
$updateServiceResult = mysqli_stmt_execute($stmtService);


    if ($updateLoginResult && $updateServiceResult) {
        // Update or insert success

        // Handle profile picture upload
        if (!empty($_FILES["file"]["name"])) {
            $targetFilePath = $targetDir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($imageFileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $updateImageQuery = "UPDATE login SET filename=? WHERE id=?";
                    $stmtImage = mysqli_prepare($conn, $updateImageQuery);
                    mysqli_stmt_bind_param($stmtImage, "si", basename($_FILES["file"]["name"]), $user_id);
                    $updateImageResult = mysqli_stmt_execute($stmtImage);

                    if ($updateImageResult) {
                        $_SESSION['status'] = "Profile Picture Uploaded Successfully";
                    } else {
                        $_SESSION['status'] = "Profile Picture Upload Failed";
                    }
                } else {
                    $_SESSION['status'] = "Sorry, there was an error uploading your profile picture.";
                }
            } else {
                $_SESSION['status'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed for profile picture.";
            }
        }

        // Handle user's images upload
        if (!empty($_FILES["workImg"]["name"])) {
            $targetFilePath = $targetDirWorkImg . basename($_FILES["workImg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($imageFileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["workImg"]["tmp_name"], $targetFilePath)) {
                    $updateImageQuery = "UPDATE service SET filename=?, uploaded_on=NOW() WHERE user_id=?";
                    $stmtImage = mysqli_prepare($conn, $updateImageQuery);
                    mysqli_stmt_bind_param($stmtImage, "si", basename($_FILES["workImg"]["name"]), $user_id);
                    $updateImageResult = mysqli_stmt_execute($stmtImage);

                    if ($updateImageResult) {
                        $_SESSION['status'] = "Details Uploaded Successfully";
                        header("Location: adminProfile.php");
                        exit;
                    } else {
                        $_SESSION['status'] = "Details Uploaded Failed (Image)";
                    }
                } else {
                    $_SESSION['status'] = "Sorry, there was an error uploading your file.";
                }
            } else {
                $_SESSION['status'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed for user's images.";
            }
        } else {
            $_SESSION['status'] = "Please select a file to upload";
        }

    } else {
        // Update or insert failed
        $_SESSION['status'] = "Details Uploaded Failed";
    }

    header("Location: adminProfile.php");
    exit;
}
?>
