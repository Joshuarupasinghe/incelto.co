<!DOCTYPE html>
<html lang="en">
<?php
include("../DBconnection/connect.php");
error_reporting(0);
session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body style="padding-top: 50px;  background-color: #e1d9d9;">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top  topnav back-dark">
            <div class="container-fluid">
                <a class="navbar-brand px-3">
                    <img src="../images/logo-no-background.svg" alt="inselto.co" width="120" class="img-fluid">
                </a>

                <button class="btn bg-white btn-profile  btn-sm-2">
                    <i class="bi bi-person-circle" style="font-size:1.6rem;"></i>
                </button>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-5 col-md-3 col-xl-2 px-sm-2 px-0 back-dark">
                <div class="mt-3 d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <a href="productsProduct.php" class="nav-link align-middle">
                                <i class="fs-4 me-2 bi bi-bag-fill"></i> <span class="ms-1 d-none d-sm-inline">Products</span></a>
                        </li>

                        <li>
                            <a href="productsOrder.php" class="nav-link align-middle active">
                                <i class="fs-4 bi-cart-fill"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-3">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">loser</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3  mt-3 back-light">
                <?php include("message.php"); ?>
                <div class="container-fluid overflow-hidden">
                    <div>
                        <h2 style="font-weight: bold;">Orders</h2>
                    </div>
                    
                <div class="container-fluid overflow-hidden">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Ordered Customer ID</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Order Complete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT cart.*, login.id, login.firstname, login.lastname, login.email
                            FROM cart
                            JOIN login ON cart.user_id = login.id;";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $order) {

                            ?>
                                    <tr>
                                        <td><?= $order["product_id"]; ?></td>
                                        <td><?= $order["product_name"]; ?></td>
                                        <td><?= $order["id"]; ?></td>
                                        <td><?= $order["firstname"]; ?>&nbsp;<?=$order["lastname"];?></td>
                                        <td><?= $order["email"]; ?></td>
                                        <td>
                                            <form action="../php/userCart.php" method="post">
                                                <input type="hidden" name="item_delete_id" value="<?= $order["id"]; ?>">
                                                <button type="submit" name="item_delete_btn" class="btn btn-primary">COMPLETE!</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No orders found</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="js/sidebars.js"></script>
</body>

</html>