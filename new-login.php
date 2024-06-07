<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/newtry.css">
</head>

<body>
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
          <li class="nav-item"><a class="nav-link" href="productslist.php">Products&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="services.php">Services&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="aboutUs.html">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="contactUs.html">Contact Us</a></li>
        </ul>
        <a href="new-signup-user.php">
          <div style="height:35px;" class="btn btn-dark btn-color1  btn-sm">Sign Up</div>
        </a>

      </div>
  </nav>



  <section class=" gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-transparent text-light" style="backdrop-filter: blur(20px) ;">
            <div class="card-body p-5 text-center">


              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />

              </svg>
              <h4 class="fw-bold mb-2 text-uppercase">Welcome to Inselt.co!</h4>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>
              <!--FORM-->
              <form action="php/login.php" method="post">
                <?php
                if (isset($_GET['error'])) { ?>
                  <p class="error"><?php echo $_GET['error']; ?></p>
                <?php
                }
                ?>
                <div class="form-outline form-white  ">
                  <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" required />
                  <label class="form-label" for="typeEmailX">Email </label>
                </div>

                <div class="form-outline form-white ">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="pwd" required />
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <p class="small pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login">Login</button>
              </form>

              <div class="d-flex justify-content-center text-center mt-4 ">
                <a href="#"><i class="bi-google mr-3" style="font-size: 20px; color: #fa4b00;"></i></a>
                <a href="#"><i class="bi bi-facebook mr-3" style="font-size: 20px; color: #fa4b00;"></i></a>
                <a href="#"><i class="bi-github mr-3" style="font-size: 20px; color: #fa4b00;"></i></a>
              </div>


              <div>
                <p class="mb-0">Don't have an account? <a href="new-signup-user.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>