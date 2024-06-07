<?php

//INSERT PRODUCT
include('../DBconnection/connect.php');
$statusMsg = '';
$targetDir = "uploads/";

if (isset($_POST['newProduct'])) {
    $user_id = $_POST["user_id"];
    $productID = $_POST["productID"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $productCategory = $_POST["productCategory"];
    $dscriptn = $_POST["dscriptn"];

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
                $query = "INSERT INTO product_details (user_id, productID,productName,price,productCategory, dscriptn,imgFile_name, uploaded_on) VALUES ('$user_id','$productID','$productName','$price','$productCategory','$dscriptn','" . $fileName . "', NOW())";
                $insert = mysqli_query($conn, $query);
                if ($insert) {
                    $_SESSION['status'] = "Details Uploaded Successfully";
                    header("Location: productsProduct.php");
                } else {
                    $_SESSION['status'] = "Details Uploaded Failed";
                    header("Location: productsProduct.php");
                }
            } else {
                $_SESSION['status'] = "Sorry, there was an error uploading your file.";
                header("Location: productsProduct.php");
            }
        } else {
            $_SESSION['status'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            header("Location: productsProduct.php");
        }
    } else {
        $_SESSION['status'] = "Please select a file to upload";
        header("Location: productsProduct.php");
    }
}
// echo $statusMs;

//UPDATE PRODUCT
if (isset($_POST['update_btn'])) {
    $itemID = $_POST["productID"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $productCategory = $_POST["productCategory"];
    $dscriptn = $_POST["dscriptn"];

    $query = "UPDATE product_details SET productName='$productName', price='$price', productCategory='$productCategory', dscriptn='$dscriptn' WHERE productID = '$itemID'";
    $insert = mysqli_query($conn, $query);

    if ($insert) {
        $_SESSION['status'] = "Details Uploaded Successfully";
        header("Location: productsProduct.php");
    } else {
        $_SESSION['status'] = "Details Uploaded Failed";
        header("Location: productsProduct.php");
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
                $query = "UPDATE product_details SET imgFile_name='" . $fileName . "', uploaded_on=NOW()  WHERE productID = '$itemID'";
                $insert = mysqli_query($conn, $query);
                if ($insert) {
                    $_SESSION['status'] = "Details Uploaded Successfully";
                    header("Location: productsProduct.php");
                } else {
                    $_SESSION['status'] = "Details Uploaded Failed";
                    header("Location: productsProduct.php");
                }
            } else {
                $_SESSION['status'] = "Sorry, there was an error uploading your file.";
                header("Location: productsProduct.php");
            }
        } else {
            $_SESSION['status'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            header("Location: productsProduct.php");
        }
    } else {
        $_SESSION['status'] = "Please select a file to upload";
        header("Location: productsProduct.php");
    }
}

//Delete Record

if (isset($_POST['item_delete_btn'])) {
    $itemID = $_POST['item_delete_id'];
    $query = "DELETE FROM product_details WHERE productID='$itemID'";
    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $_SESSION['status'] = "Deleted Successfully";
        header("Location: productsProduct.php");
    } else {
        $_SESSION['status'] = "Delete Failed";
        header("Location: productsProduct.php");
    }
}

$conn->close();
