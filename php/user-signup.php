<?php
include("alertBox.php");
include("dataValidation.php");
include('../DBconnection/connect.php');
$statusMsg = '';
$targetDir = "../profilePic/";

if (isset($_POST['signUp'])) {
    $fname = data_valid($_POST["fname"]);
    $lname = data_valid($_POST["lname"]);
    $bday = data_valid($_POST["bday"]);
    $email = data_valid($_POST["email"]);
    $pwd = data_valid($_POST["pwd"]);
    $telNo = data_valid($_POST["telNo"]);
    $userRole = data_valid($_POST["userRole"]);

    $query = "INSERT INTO login (firstName,lastName,birthdate,email,password,telNo ,role) VALUES 
                ('$fname','$lname','$bday','$email','$pwd','$telNo','$userRole')";
    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $_SESSION['status'] = "Details Uploaded Successfully";
        echo "Details Uploaded Successfully";
        // header("Location: ../index.php");
    } else {
        $_SESSION['status'] = "Details Uploaded Failed";
        echo "Details Uploaded Failed";
        // header("Location: ../index.php");
    }
    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $query = "UPDATE login SET upload_date = NOW(), filename = '$fileName' WHERE email='$email'";
                $insert = mysqli_query($conn, $query);
                if ($insert) {
                    echo '<script type="text/javascript">'; 
                    echo 'window.location.href="../index.php";'; 
                    echo '</script>';
                } else {
                    header("Location: ../index.php");
                    echo '<script type="text/javascript">'; 
                    echo 'window.location.href="../index.php";'; 
                    echo '</script>';
                }
            } else {
                    echo '<script type="text/javascript">'; 
                    echo 'window.location.href="../index.php";'; 
                    echo '</script>';
            }
        } else {
            echo '<script type="text/javascript">'; 
            echo 'window.location.href="../index.php";'; 
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="../index.php";'; 
        echo '</script>';
    }
}
