<?php
include("alertBox.php");
include("../DBconnection/connect.php");

if (isset($_POST['addtoCart1'])) {
    $user_id = $_POST["user_id"];
    $productID = $_POST["productID"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $category = $_POST["category"];


    $cart_query = "INSERT INTO cart (product_id, product_name, price, user_id) VALUES (?, ?, ?, ?)";
    $cart_statement = mysqli_prepare($conn, $cart_query);
    mysqli_stmt_bind_param($cart_statement, "issi", $productID, $productName, $price, $user_id);
    $cart_insert = mysqli_stmt_execute($cart_statement);


    if ($cart_insert) {
        // Retrieve the last inserted cart_id
        $get_cart_id = "SELECT LAST_INSERT_ID() AS cart_id";
        $result = mysqli_query($conn, $get_cart_id);
        $row = mysqli_fetch_assoc($result);
        $cart_id = $row['cart_id'];

        // Insert into orders table
        $orders_query = "INSERT INTO orders (cart_id, product_id, user_id) VALUES (?, ?, ?)";
        $orders_statement = mysqli_prepare($conn, $orders_query);
        mysqli_stmt_bind_param($orders_statement, "iii", $cart_id, $productID, $user_id);
        $orders_insert = mysqli_stmt_execute($orders_statement);
    }
    if ($cart_insert && $orders_insert) {
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="../products.php?category=$category&msgProd1=Item Added to Cart";'; 
        echo '</script>';
    } else {
        echo "Details Uploaded Failed";
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="../products.php?category=$category";'; 
        echo '</script>';
    }

    mysqli_stmt_close($cart_statement);
    mysqli_stmt_close($orders_statement);
}

if (isset($_POST['addtoCart2'])) {
    $user_id = $_POST["user_id"];
    $productID = $_POST["productID"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $category = $_POST["category"];


    $cart_query = "INSERT INTO cart (product_id, product_name, price, user_id) VALUES (?, ?, ?, ?)";
    $cart_statement = mysqli_prepare($conn, $cart_query);
    mysqli_stmt_bind_param($cart_statement, "issi", $productID, $productName, $price, $user_id);
    $cart_insert = mysqli_stmt_execute($cart_statement);

    if ($cart_insert) {
        // Retrieve the last inserted cart_id
        $get_cart_id = "SELECT LAST_INSERT_ID() AS cart_id";
        $result = mysqli_query($conn, $get_cart_id);
        $row = mysqli_fetch_assoc($result);
        $cart_id = $row['cart_id'];

        // Insert into orders table
        $orders_query = "INSERT INTO orders (cart_id, product_id, user_id) VALUES (?, ?, ?)";
        $orders_statement = mysqli_prepare($conn, $orders_query);
        mysqli_stmt_bind_param($orders_statement, "iii", $cart_id, $productID, $user_id);
        $orders_insert = mysqli_stmt_execute($orders_statement);

        if ($cart_insert && $orders_insert) {
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="../products.php?category=$category&msgProd2=Item Added to Cart";'; 
        echo '</script>';
        } else {
            echo "Details Uploaded Failed";
            echo '<script type="text/javascript">'; 
            echo 'window.location.href="../products.php?category=$category";'; 
            echo '</script>';
        }
    }
    mysqli_stmt_close($cart_statement);
    mysqli_stmt_close($orders_statement);
}

//Delete Record

if (isset($_POST['item_delete_btn'])) {
    $itemID = $_POST['item_delete_id'];

    // Delete from cart table
    $cart_query = "DELETE FROM cart WHERE id=?";
    $cart_statement = mysqli_prepare($conn, $cart_query);
    mysqli_stmt_bind_param($cart_statement, "i", $itemID);
    $cart_delete = mysqli_stmt_execute($cart_statement);

    // Delete from orders table
    $orders_query = "DELETE FROM orders WHERE cart_id=?";
    $orders_statement = mysqli_prepare($conn, $orders_query);
    mysqli_stmt_bind_param($orders_statement, "i", $itemID);
    $orders_delete = mysqli_stmt_execute($orders_statement);

    if ($cart_delete && $orders_delete) {
        $_SESSION['status'] = "Deleted Successfully";
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="../cart.php";'; 
        echo '</script>';
    } else {
        $_SESSION['status'] = "Delete Failed";
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="../cart.php";'; 
        echo '</script>';
    }

    mysqli_stmt_close($cart_statement);
    mysqli_stmt_close($orders_statement);
}


// function addToCart($product_id, $quantity, $user_id) {
//     global $conn;

//     $query = "INSERT INTO cart (product_id, quantity, user_id) VALUES ('$product_id', '$quantity', '$user_id')";
//     mysqli_query($conn, $query);
// }

// function getCartItems($user_id) {
//     global $conn;

//     $query = "SELECT cart.id, product_details.productName, product_details.price, cart.quantity FROM cart INNER JOIN product_details ON cart.product_id = product_details.productID WHERE user_id = '$user_id'";
//     $result = mysqli_query($conn, $query);

//     return mysqli_fetch_all($result, MYSQLI_ASSOC);
// }

// // Function to delete an item from the cart
// function removeFromCart($cart_id) {
//     global $conn;

//     $query = "DELETE FROM cart WHERE id = '$cart_id'";
//     mysqli_query($conn, $query);
// }
