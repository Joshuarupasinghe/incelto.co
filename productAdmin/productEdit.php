<!DOCTYPE html>
<html lang="en">
<?php
include("../DBconnection/connect.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
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
                            <a href="#" class="nav-link align-middle">
                                <i class="fs-4 me-2 bi bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link align-middle active">
                                <i class="fs-4 me-2 bi bi-bag-fill"></i> <span class="ms-1 d-none d-sm-inline">Products</span></a>
                        </li>

                        <li>
                            <a href="#" class="nav-link align-middle">
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
                <div class="container-fluid overflow-hidden">
                    <div>
                        <h2 style="font-weight: bold;">Edit Products</h2>
                    </div>
                    <a href="productsProduct.php" class="btn btn-dark btn-color1">
                        <- Go Back </a>
                </div>
                <div class="container-fluid">
                    <form method="post" action="newProduct.php" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET['productID'])) {
                            $itemID = $_GET['productID'];
                            $query = "SELECT * FROM product_details WHERE productID = '$itemID'";
                            $query_run = mysqli_query($conn,$query);

                            foreach($query_run as $item):
                        ?>
                            <input type="hidden" name="productID" value="<?= $item['productID'] ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="productName" class="form-label text-dark">Product Name</label>
                                    <input type="text" class="form-control" id="productName" name="productName" value="<?=$item['productName'];?>">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label text-dark">Product Price(Rs.)</label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?=$item['price'];?>">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label text-dark">Category</label>
                                    <select class="form-select" aria-label="Default select example" name="productCategory">
                                        <option selected><?=$item['productCategory'];?></option>
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
                                    <textarea class="form-control" id="description" name="dscriptn"><?=$item['dscriptn'];?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Insert Image</label>
                                    <input class="form-control" type="file" id="formFile" name="file">
                                    <input type="text" readonly class="form-control-plaintext" id="formFile" value="<?=$item['imgFile_name'];?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="productsProduct.php" class="btn btn-dark btn-color2"><-Back</a>&nbsp;
                                <button type="submit" class="btn btn-dark btn-color1" name="update_btn">Save changes</button>
                            </div>
                        <?php
                        endforeach;
                        }else{
                            echo "No Product ID Found";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="js/sidebars.js"></script>
</body>

</html>