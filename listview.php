<?php
session_start();
include("DBconnection/connect.php");
include("php/alertBox.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/list.css">
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
          <li class="nav-item"><a class="nav-link" href="productslist.php">Products&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link active" href="services.php">Services&nbsp;</a></li>
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
                <img src="profilePic/<?= $profile_picture; ?>" alt="Profile Picture" width=50 height=50 class="img-fluid" style="border-radius: 50%;" data-bs-toggle="dropdown">
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
          echo '<a href="new-login.php"><div class="btn btn-dark btn-color1 btn-sm">Login/Sign Up</div></a>';
        }
        ?>
      </div>
  </nav>
  <br>
  <div class="grid-list-search-layout custom-container">
    <div class="row pt-3">
      <div class="col-lg-3 col-sm-12 col-md-4 grid-list-sidebar no-mobile">
        <div class="sub-container" id="leftbar-categories">
          <ul id="accordion" class="accordion">
            <li class="open">

              <ul class="submenu open" id="myBtnContainer">
                <div class="link">Categories</div>
                <a class="button-81" href="listview.php?category=Architects" onclick="filterSelection('Architects')" id="Architects"><img src="images/1.png" class="ico-img img-fluid">Architects</a>
                <a class="button-81" href="listview.php?category=CivilEngineers" onclick="filterSelection('CivilEngineers')" id="CivilEngineers"><img src="images/2.png" class="ico-img img-fluid">Civil Engineers</a>
                <a class="button-81" href="listview.php?category=Masons" onclick="filterSelection('Masons')" id="Masons"><img src="images/3.png" class="ico-img img-fluid">Masons</a>
                <a class="button-81" href="listview.php?category=Painters" onclick="filterSelection('Painters')" id="Painters"><img src="images/4.png" class="ico-img img-fluid">Painters</a>
                <a class="button-81" href="listview.php?category=Plumbers" onclick="filterSelection('Plumbers')" id="Plumbers"><img src="images/5.png" class="ico-img img-fluid">Plumbers</a>
                <a class="button-81" href="listview.php?category=Roofers" onclick="filterSelection('Roofers')" id="Roofers"><img src="images/6.png" class="ico-img img-fluid">Roofers</a>
                <a class="button-81" href="listview.php?category=Electricians" onclick="filterSelection('Electricians')" id="Electricians"><img src="images/7.png" class="ico-img img-fluid">Electricians</a>
                <a class="button-81" href="listview.php?category=LandscapeDesigners" onclick="filterSelection('LandscapeDesigners')" id="LandscapeDesigners"><img src="images/8.png" class="ico-img img-fluid">Landscape Designers</a>
                <a class="button-81" href="listview.php?category=VehicleProviders" onclick="filterSelection('VehicleProviders')" id="VehicleProviders"><img src="images/9.png" class="ico-img img-fluid">Vehicle Providers</a>
                <a class="button-81" href="listview.php?category=MachineRenters" onclick="filterSelection('MachineRenters')" id="MachineRenters"><img src="images/10.png" class="ico-img img-fluid">Machine Renters</a>
                <a class="button-81" href="listview.php?category=DeliveryProviders" onclick="filterSelection('DeliveryProviders')" id="DeliveryProviders"><img src="images/11.png" class="ico-img img-fluid">Delivery Providers</a>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <?php
      // Check if the category parameter is set in the URL
      if (isset($_GET['category'])) {
        // Get the category value from the URL
        $category = $_GET['category'];
      }
      ?>
      <div class="col-lg-9 col-md-11 col-sm-12 align-items-center">
        <div class="col-md-12 offset-md-2">
          <div class="slider-form-section">
            <form>
              <div class="row">
                <div class="col-md-5 p-0">
                  <div class="form-group">
                    <input type="text" class="bar-control form-border" placeholder="What are you looking for ?">
                  </div>
                </div>

                <div class="col-md-2 p-0">
                  <div class="form-group">
                    <select class="custom-select  select bar-control">
                      <option selected>Select City</option>
                      <option value="1">Akkaraipattu</option>
                      <option value="2">Ampara</option>
                      <option value="3">Anuradhapura</option>
                      <option value="4">Badulla</option>
                      <option value="5">Balangoda</option>
                      <option value="6">Bandarawela</option>
                      <option value="8">Batticaloa</option>
                      <option value="9">Chavakachcheri</option>
                      <option value="10">Chilaw</option>
                      <option value="11">Colombo</option>
                      <option value="12">Dambulla</option>
                      <option value="13">Dehiwela-Mount Lavinia</option>
                      <option value="14">Embilipitiya</option>
                      <option value="15">Eravur</option>
                      <option value="16">Galle</option>
                      <option value="17">Gampaha</option>
                      <option value="18">Gampola</option>
                      <option value="19">Hambantota</option>
                      <option value="20">Happutalle</option>
                      <option value="21">Homagama</option>
                      <option value="22">Jaffna</option>
                      <option value="23">Kalmunai</option>
                      <option value="24">Kalutara</option>
                      <option value="25">Kandy</option>
                      <option value="26">Kattankudy</option>
                      <option value="27">Kegalle</option>
                      <option value="28">Kinniya</option>
                      <option value="29">Kurunegala</option>
                      <option value="30">Kuliyapitiya</option>
                      <option value="31">Mahiyanganaya</option>
                      <option value="32">Mannar</option>
                      <option value="33">Matale</option>
                      <option value="34">Matara</option>
                      <option value="35">Mawathagama</option>
                      <option value="36">Mihintale</option>
                      <option value="37">Monaragala</option>
                      <option value="38">Mulleriyawa</option>
                      <option value="39">Negombo</option>
                      <option value="40">Nuwara Eliya</option>
                      <option value="41">Padukka</option>
                      <option value="42">Puttalam</option>
                      <option value="43">Polonnaruwa</option>
                      <option value="44">Point Pedro</option>
                      <option value="45">Ratnapura</option>
                      <option value="46">Sri Jayewardenepura Kotte</option>
                      <option value="47">Thambiluvil</option>
                      <option value="48">Trincomalee</option>
                      <option value="49">Valvettithurai</option>
                      <option value="50">Vavuniya</option>
                      <option value="51">Vijitapura</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2 p-0">
                  <div class="form-group">
                    <input type="submit" class="submit" value="search" />
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <br>
        <br>
        <div class="col-lg-12 m-0 p-0">
          <div class="pull-back row">
            <h2 class="search-results-title">Result : Service Providers</h2>
          </div>

          <table class="table table-borderless">
            <tbody>
              <?php
                $query_service = "SELECT service.user_id, service.workAreas, login.firstName, login.lastName, login.filename
                FROM service
                JOIN login ON service.user_id = login.id
                WHERE service.jobRole = '$category'";
                $query_run_service = mysqli_query($conn, $query_service);

                if ($query_run_service) {
                  while ($row = mysqli_fetch_assoc($query_run_service)) {
                    $user_id = $row['user_id'];
                    $workAreas = $row['workAreas'];
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $filename = $row['filename'];
              ?>

                    <tr>
                      <td class="card-container">
                        <div class="row">
                          <!-- Service Provider -->
                          <div class="col-lg-6 mb-4 mid-card">
                            <a href="profile.php?user_id=<?= $user_id ?>">
                              <div class="pic-card col-md-4 col-lg-12">
                                <div class="card-body d-flex align-items-center">
                                  <img src="profilePic/<?= $filename ?>" class="pro-img img-fluid">
                                  <div class="ms-3 flex-grow-1">
                                    <h5 class="card-title"><?= $firstName ?>&nbsp;<?= $lastName ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa-solid fa-location-dot"></i>&nbsp;<?= $workAreas ?></h6>
                                    <img class="cat_img" src="" alt="" title="">
                                  </div>
                                </div>
                              </div>
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <tr>
                    <td colspan="6">No products found, please select a different category</td>
                  </tr>
              <?php
                }
              ?>
            </tbody>
          </table>


        </div>

      </div>
    </div>
  </div>
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


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/fillter.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.4.1.js"></script>
  <script src="js/card.js"></script>

  <script>
    function filterSelection(selectedCategory) {
      var cardImages = document.getElementsByClassName("cat_img");

      // You can customize the image URLs based on your categories
      var imageSources = {
        Architects: "images/1.png",
        CivilEngineers: "images/2.png",
        Masons: "images/3.png",
        Painters: "images/4.png",
        Plumbers: "images/5.png",
        Roofers: "images/6.png",
        Electricians: "images/7.png",
        LandscapeDesigners: "images/8.png",
        VehicleProviders: "images/9.png",
        MachineRenters: "images/10.png",
        DeliveryProviders: "images/11.png"
      };

      // Store the selected category in localStorage
      localStorage.setItem('selectedCategory', selectedCategory);


      // Loop through each card and set the image source based on the selected category
      for (var i = 0; i < cardImages.length; i++) {
        var cardId = cardImages[i].id;
        cardImages[i].src = imageSources[selectedCategory];
      }
    }

    // Retrieve the selected category from localStorage on page load
    var storedCategory = localStorage.getItem('selectedCategory');
    if (storedCategory) {
      filterSelection(storedCategory);
    } else {
      // Default category if none is stored
      filterSelection('Architects');
      filterSelection('CivilEngineers');
      filterSelection('Masons');
      filterSelection('Painters');
      filterSelection('Plumbers');
      filterSelection('Roofers');
      filterSelection('Electricians');
      filterSelection('LandscapeDesigners');
      filterSelection('VehicleProviders');
      filterSelection('MachineRenters');
      filterSelection('DeliveryProviders');
    }
  </script>



</body>

</html>