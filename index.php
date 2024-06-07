<?php
ob_start();
session_start();
include("DBconnection/connect.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>inselto.co</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel=" stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/card.css">
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
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="productslist.php">roducts&nbsp;</a></li>
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
            <input type="hidden" value="<?=$user_id?>">
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
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ?>



      </div>
    </div>
  </nav>

  <!-- Carousel -->
  <div id="slider1" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/carousel1.jpg" class="d-block img-fluid">
      </div>
      <div class="carousel-item">
        <img src="images/carousel2.png" class="d-block img-fluid">
      </div>
      <div class="carousel-item">
        <img src="images/carousel3.png" class="d-block img-fluid">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slider1" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slider1" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Content -->
  <section class="back-dark">
    <div class="container-fluid mx-auto">
      <p class="headingsDark pt-5 mb-5 hidden">Welcome to <span style="color: #FF6B2E;">INSELTO.CO</span></p>

      <div class="row mobileView">
        <div class="col-7 mb-5  hidden">
          <p class="textDark">We have created a single place from building your home to getting
            everything you
            need.
            Our website provides you the best people who will help you to build the home that you always dreamed of. Our
            website comes with a marketplace to buy all the things you need in achieving that dream.
            From the bricks to the all the electronic appliances you need for your home for the right price.</p>

          <p class="textDark">With our platform, you have the convenience of a one-stop shop, making the journey from
            envisioning your dream home to living in it a seamless and enjoyable experience.
            We are committed to helping you achieve your dream home, step by step, and provide you with access to the
            professionals and resources you need to make it happen.</p>


          <p class="textDark">Our platform offers a range of services, connecting you with experienced architects,
            builders, and
            interior designers who will work closely with you to craft a home that matches your unique preferences and
            requirements.
            Whether you're seeking a modern, minimalist design or a classic, timeless aesthetic, our team of
            professionals is dedicated
            to turning your dreams into reality.

            In addition to our expert services, our website features a dynamic marketplace where you can find all the
            essential materials
            and products necessary for your home construction and furnishing projects. We understand the importance of
            quality and affordability,
            which is why our marketplace offers an extensive selection of construction materials, from top-quality
            bricks to energy-efficient
            electronic appliances, all priced competitively to ensure you get the best value for your investment</p>


        </div>
        <div class="col mb-5">
          <img src="images/website.png" alt="" class="img-fluid floating img-remove" width="1000">
        </div>
      </div>
    </div>
  </section>

  <div class="bgimg-1 img-fluid">
    <div class="caption headingsDark">
      Need Help? We Got You Covered
    </div>
  </div>

  <div class="container-fluid mt-5">
    <p class="hidden headingsLight">How Our Website <span style="color: #F1B73C;">Works?</span></p>
    <div class="row mb-5 mobileView">
      <div class="col">
        <img src="images/how.png" alt="" class="img-fluid floating img-remove" width="1000">
      </div>
      <div class="col-7 textLight hidden text-cent">
        <p>We have collected the right shops and the right people just around you to
          build
          your
          house from scratch. So you can contact them easily.
          People can register their businesses wihtin our website to publish an advertiesment about their products. Our
          aim is to help people who
          are conducting small businesses.</p>
        <p>Our website provides you with the talented people to design your house, build your house and to maintatin yor
          house.
          Every single one of them can register within our website can be contacted for them to be contracted.
        </p>
        <p>Every product and service within our website is sorted from the best. If you are a Products provider or a
          service provider register within our website
          by clicking the following button.
        </p>
        <div class="row mobileView">
          <div class="col-7">
            <div class="btn btn-dark btn-color1">Register Now!</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bgimg-2 img-fluid">
    <div class="caption headingsLight">
      One Place for Everything You Need
    </div>
  </div>
  </div>

  <div class="container mt-5 mb-5">
    <p class="headingsLight" style="color: #F1B73C;">Products</p>
    <fieldset>
      <p class="textLight hidden">Our website gives you all the things that you need to build your house and every
        accessories you
        you need at your house. From the basic raw materials to every electronic appliances. All of these things are
        from around your area,
        so you don't need to worry about the access to these products.
        Order now! Just click the category you need from below.
      </p>

      <div class="row row-cols-1 row-cols-md-4 g-4 hero-section mb-4 logos">
        <div class="col logo hidden">
          <a class="card bg-dark textDark" href="#">
            <img src="images/furniture.jpg" class="card-img img-fluid" alt="...">
            <div class="card-img-overlay d-flex flex-column justify-content-end">
              <h5 class="card-title">Furniture</h5>
            </div>
          </a>
        </div>
        <div class="col logo hidden">
          <a class="card bg-dark textDark" href="#">
            <img src="images/electrical.jpg" class="card-img img-fluid" alt="...">
            <div class="card-img-overlay d-flex flex-column justify-content-end">
              <h5 class="card-title">Electrical</h5>
            </div>
          </a>
        </div>
        <div class="col logo hidden">
          <a class="card card bg-dark textDark" href="#">
            <img src="images/oranaments.jpg" class="card-img img-fluid" alt="...">
            <div class="card-img-overlay  d-flex flex-column justify-content-end">
              <h5 class="card-title">Ornaments</h5>
            </div>
          </a>
        </div>
      </div>

    </fieldset>
    <div class="text-center">
      <button class="btn btn-dark btn-color2 mx-auto">View all Products -></button>
    </div>
  </div>

  <div class="container mt-5 mb-5">
    <p class="headingsLight" style="color: #F1B73C;">Services</p>
    <fieldset>
      <p class="textLight hidden">Our website provides you with the talented people to design your house, build your
        house
        and to
        maintatin yor house.
        Every single one of them can register within our website can be contacted for them to be contracted.
        Give a call to them right now just click the service category you need from below.
      </p>

      <div class="row row-cols-1 row-cols-md-4 g-4 hero-section mb-4 logos">
        <div class="col logo hidden">
          <a class="card bg-dark textDark" href="#">
            <img src="images/Architects.jpg" class="card-img img-fluid" alt="...">
            <div class="card-img-overlay d-flex flex-column justify-content-end">
              <h5 class="card-title">Architects</h5>
            </div>
          </a>
        </div>
        <div class="col logo hidden">
          <a class="card bg-dark textDark" href="#">
            <img src="images/mason.jpg" class="card-img img-fluid" alt="...">
            <div class="card-img-overlay d-flex flex-column justify-content-end">
              <h5 class="card-title">Masons</h5>
            </div>
          </a>
        </div>
        <div class="col logo hidden">
          <a class="card card bg-dark textDark" href="#">
            <img src="images/plumber.jpg" class="card-img img-fluid" alt="...">
            <div class="card-img-overlay  d-flex flex-column justify-content-end">
              <h5 class="card-title">Plumbers</h5>
            </div>
          </a>
        </div>
      </div>

    </fieldset>
    <div class="text-center">
      <button class="btn btn-dark btn-color2 mx-auto">View all Services -></button>
    </div>
  </div>

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
  <script src="js/navbar.js"></script>
  <script src="js/app.js"></script>
</body>


</html>
<?php
ob_flush();
?>