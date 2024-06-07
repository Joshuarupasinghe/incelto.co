<?php
session_start();
include("../DBconnection/connect.php");
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
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
                <a class="navbar-brand px-3" href="../index.php">
                    <img src="../images/logo-no-background.svg" alt="inselto.co" width="120" class="img-fluid">
                </a>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-5 col-md-3 col-xl-2 px-sm-2 px-0 back-dark">
                <div class="mt-3 d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <a href="productsProduct.php" class="nav-link align-middle active">
                                <i class="fs-4 me-2 bi bi-bag-fill"></i> <span class="ms-1 d-none d-sm-inline">Products</span></a>
                        </li>

                        <li>
                            <a href="productsOrder.php" class="nav-link align-middle">
                                <i class="fs-4 bi-cart-fill"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
            
                </div>
            </div>
            <div class="col py-3  mt-3 back-light">
                <?php include("message.php"); ?>
                <div class="container-fluid overflow-hidden">
                    <div>
                        <h2 style="font-weight: bold;">Products</h2>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark btn-color1" data-bs-toggle="modal" data-bs-target="#addProducts">
                        + Add Products
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addProducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add a New Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?php
                                if (isset($_SESSION['id'])) {
                                $userID = $_SESSION['id'];
                                ?>
                                <form method="post" action="newProduct.php" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?=$userID?>" name="user_id">
                                        <div class="mb-3">
                                            <label for="productID" class="form-label text-dark">Product ID</label>
                                            <input type="text" class="form-control" id="productID" name="productID">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productName" class="form-label text-dark">Product Name</label>
                                            <input type="text" class="form-control" id="productName" name="productName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label text-dark">Price</label>
                                            <input type="text" class="form-control" id="price" name="price">
                                        </div>
                                        <div class="mb-3">
                                            <label for="category" class="form-label text-dark">Category</label>
                                            <select class="form-select" aria-label="Default select example" name="productCategory">
                                                <option value="furniture">Furniture</option>
                                                <option value="ElecApp">Electrical Appliances</option>
                                                <option value="ornaments">Ornaments</option>
                                                <option value="CerPor">Ceramic and Porcelain</option>
                                                <option value="hardware">Hardware</option>
                                                <option value="GardenDeco">Garden Decores</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label text-dark">Description</label>
                                            <textarea class="form-control" id="description" name="dscriptn"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Insert Image</label>
                                            <input class="form-control" type="file" id="formFile" name="file">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark btn-color2" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark btn-color1" name="newProduct">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid overflow-hidden">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Price (Rs.)</th>
                                <th>Product Category</th>
                                <th>Product Description</th>
                                <th>Edit Product</th>
                                <th>Delete Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM product_details WHERE user_id='$userID'";
                                $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $productItem) {

                            ?>
                                    <tr>
                                        <td><?= $productItem["productID"]; ?></td>
                                        <td><?= $productItem["productName"]; ?></td>
                                        <td><?= $productItem["price"]; ?></td>
                                        <td><?= $productItem["productCategory"]; ?></td>
                                        <td><?= $productItem["dscriptn"]; ?></td>
                                        <td>
                                            <a href="productEdit.php?productID=<?= $productItem["productID"]; ?>" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <form action="newProduct.php" method="post">
                                                <input type="hidden" name="item_delete_id" value="<?= $productItem["productID"]; ?>">
                                                <button type="submit" name="item_delete_btn" class="btn btn-danger">Delete</button>
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