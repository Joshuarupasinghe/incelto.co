<?php
session_start();
include("DBconnection/connect.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/productInfo.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top topnav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo-no-background.svg" alt="inselto.co" width="120" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="productslist.php">Products&nbsp;</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services&nbsp;</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutUs.html">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactUs.html">Contact Us</a></li>
                </ul>
            </div>
    </nav>
    <br>
    <section class="profile-container">
        <!-- Display cart items -->
        <div class="container-fluid overflow-hidden">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price (Rs.)</th>
                        <th>Delete Item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM cart";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $cartItem) {

                    ?>
                            <tr>
                                <td><?= $cartItem["product_id"]; ?></td>
                                <td><?= $cartItem["product_name"]; ?></td>
                                <td><?= $cartItem["price"]; ?></td>
                                <td>
                                    <form action="php/userCart.php" method="post">
                                        <input type="hidden" name="item_delete_id" value="<?= $cartItem["id"]; ?>">
                                        <button type="submit" name="item_delete_btn" class="btn btn-danger btn-color1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">No products found</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </section>

    <!-- footer -->
    <section class="back-dark">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col mt-5">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="footerItem">Home</a></li>
                        <li><a href="productslist.php" class="footerItem">Products</a></li>
                        <li><a href="services.php" class="footerItem">Services</a></li>
                        <li><a href="aboutUs.html" class="footerItem">About Us</a></li>
                    </ul>
                </div>
                <div class="col mt-5">
                    <h5>Products</h5>
                    <ul class="list-unstyled">
                        <li><a href="products.php?category=furniture" class="footerItem">Furniture</a></li>
                        <li><a href="products.php?category=ElecApp" class="footerItem">Electrical Appliances</a></li>
                        <li><a href="products.php?category=ornaments" class="footerItem">Ornaments</a></li>
                        <li><a href="products.php?category=CerPor" class="footerItem">Ceramic and Porcelain</a></li>
                        <li><a href="products.php?category=hardware" class="footerItem">Hardware</a></li>
                    </ul>
                </div>
                <div class="col mt-5">
                    <h5>Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="listview.html?category=Architects" class="footerItem">Architects</a></li>
                        <li><a href="listview.html?category=CivilEngineers" class="footerItem">Civil Engineers</a></li>
                        <li><a href="listview.html?category=Masons" class="footerItem">Masons</a></li>
                        <li><a href="listview.html?category=Plumbers" class="footerItem">Plumbers</a></li>
                        <li><a href="listview.html?category=Painters" class="footerItem">Painters</a></li>
                        <li><a href="listview.html?category=Roofers" class="footerItem">Roofers</a></li>
                        <li><a href="listview.html?category=Electricians" class="footerItem">Electricians</a></li>
                        <li><a href="listview.html?category=LandscapeDesigners" class="footerItem">Landscape Designers</a></li>
                        <li><a href="listview.html?category=VehicleProviders" class="footerItem">Vehicle Providers</a></li>
                        <li><a href="listview.html?category=MachineRenters" class="footerItem">Machine Renters</a></li>
                        <li><a href="listview.html?category=DeliveryProviders" class="footerItem">Delivery Providers</a></li>
                    </ul>
                </div>

                <div class="col mt-5">
                    <h5>Reach Us</h5>
                    <form>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="message" rows="5" placeholder="Your message..."></textarea>
                        </div>
                    </form>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark btn-color1 mb-3">Send</button>
                    </div>
                </div>
            </div>
            <div class="border-bottom border-light"></div>
        </div>

        <div class="text-center mt-4">
            <img src="images/logo-no-background.svg" alt="" width="120">

            <p class="textMuted">A Group Project By Group 42 From NSBM Green University
                <br>© 2023 All Rights Reserved
            </p>
        </div>
        <div class="col textDark text-center pb-4 ">
            <div class="footerIcons">
                <a href="https://www.nsbm.ac.lk/"><i class="bi bi-globe2" style="font-size: 20px; color: white;" data-toggle="tooltip" data-placement="bottom" title="NSBM Green University Town"></i></a>
                <a href="#"><i class="bi bi-envelope-at-fill" style="font-size: 20px; color: white;"></i></a>
                <a href="#"><i class="bi bi-facebook" style="font-size: 20px; color: white;"></i></a>
                <a href="#"><i class="bi bi-instagram" style="font-size: 20px; color: white;"></i></a>
                <a href="#"><i class="bi bi-twitter" style="font-size: 20px; color: white;"></i></a>
            </div>
        </div>
    </section>
    <script src="js/cart.js"></script>
</body>

</html>