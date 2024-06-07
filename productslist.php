<?php
session_start();
include("DBconnection/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel=" stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/product.css">
  <link rel="stylesheet" href="css/main.css">
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
        <?php
        if (isset($_SESSION['id'])) {
          $user_id = $_SESSION['id'];

          $query = "SELECT filename, role FROM login WHERE id=?";
          $stmt = mysqli_prepare($conn, $query);
          mysqli_stmt_bind_param($stmt, "i", $user_id);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);

          if ($result) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data) {
              $profile_picture = $user_data['filename'];
              $user_type = $user_data['role'];

              // Dynamically set links based on user type
              switch ($user_type) {
                case 'customer':
                  $profileLink = 'cart.php';
                  break;
                case 'ServiceProvider':
                  $profileLink = 'serviceAdmin/adminProfile.php';
                  break;
                case 'ProductProvider':
                  $profileLink = 'productAdmin/productsProduct.php';
                  break;
                default:
                  $profileLink = '#';
              }
        ?>
              <div class="d-flex align-items-center">
                <img src="profilePic/<?=$profile_picture;?>" alt="Profile Picture" width=50 height=50 class="img-fluid" style="border-radius: 50%;" data-bs-toggle="dropdown">
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="<?php echo $profileLink; ?>">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="php/logout.php">Logout</a>
                </div>
              </div>
        <?php
            } else {
              echo "User data not found";
            }
          } else {
            echo "Error in executing query: " . mysqli_error($conn);
          }

          mysqli_stmt_close($stmt);
        } else {
          echo '<a href="new-login.php"><div class="btn btn-dark btn-color1 btn-sm">Log in/Sign Up</div></a>';
        }
        ?>
      </div>
    </div>

  </nav>
  <section>
    <div class="container-fluid custom-div">
      <div class="row">
        <div class="col-md-7 title-text floating float-text">
          <h5 class="hidden">" Build Your Dream "</h5>
          <h1>Our Products</h1>
        </div>
        <div class="col-md-5">
          <img src="images/pimg.png" alt="" width="600vw" class="floating img-fluid img-view float-right">
        </div>
      </div>
    </div>
  </section>

  <div class="container-fluid custom-container">
    <div class="list-view-cm">
      <div class="list-view-cm__header">
        <div class="list-view-cm__title">
          <h2>Products</h2>
        </div>
        <div class="list-view-cm__subtitle">
          <h3 class="text-center">Welcome to INCELTO.CO Products. We provide you with the best skilled personal from
            around you.&nbsp;</h3>
          <h3 class="text-center">Choose your preferred Category from the following,</h3>
        </div>
      </div>
    </div>
    <section>

      <div class="row logos hero-section">
        <div class="col-md-4 logo hidden">
          <a class="card col-md-12" href="products.php?category=furniture" onclick="filterSelection('furniture')">
            <div class="card__background" style="background-image: url('./images/furniture.jpg')">
              <div class="image-text">Furniture</div>
            </div>
          </a>
        </div>
        <div class="col-md-4 logo hidden">
          <a class="card col-md-12" href="products.php?category=ElecApp" onclick="filterSelection('furniture')">
            <div class="card__background" style="background-image: url('images/electrical.jpg')">
              <h4>Electrical</h4>
              <div class="image-text">Appliances</div>
            </div>
          </a>
        </div>
        <div class="col-md-4 logo hidden">
          <a class="card col-md-12" href="products.php?category=ornaments" onclick="filterSelection('ornaments')">
            <div class="card__background" style="background-image: url('images/oranaments.jpg')">
              <div class="image-text">Ornaments</div>
            </div>
          </a>
        </div>
      </div>
      <div class="row logos hero-section">
        <div class="col-md-4 logo hidden">
          <a class="card col-md-12" href="products.php?category=CerPor" onclick="filterSelection('CerPor')">
            <div class="card__background" style="background-image: url('./images/ceramic.jpg')">
              <h4>Ceramic</h4>
              <div class="image-text">Porcelain</div>
            </div>
          </a>
        </div>
        <div class="col-md-4 logo hidden">
          <a class="card col-md-12" href="products.php?category=hardware" onclick="filterSelection('hardware')">
            <div class="card__background" style="background-image: url('images/hardware.jpg')">
              <div class="image-text">Hardware</div>
            </div>
          </a>
        </div>
        <div class="col-md-4 logo hidden">
          <a class="card col-md-12" href="products.php?category=GardenDeco" onclick="filterSelection('GardenDeco')">
            <div class="card__background" style="background-image: url('images/deco.jpg')">
              <h4>Garden</h4>
              <div class="image-text">Decors</div>
            </div>
          </a>
        </div>
      </div>
    </section>
  </div>

  <br>
  <br>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="js/card.js"></script>
  <script src="js/navbar.js"></script>
  <script src="js/app.js"></script>
</body>

</html>