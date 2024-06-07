<?php
session_start();
include("../DBconnection/connect.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Architects</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/main.css">

  <style>
    .cos-div {
      max-width: 100%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-wrap: wrap;
    }

    .profile-container {
      width: 100%;
      text-align: center;
    }

    .img-prof {
      max-width: 100%;
      width: 200px;
      border-radius: 50%;
      margin-top: 55px;
      margin-bottom: 40px;
    }


    p {
      font-size: 16px;
    }

    b {
      font-size: 20px;
    }

    h2 {
      font-size: 40px;
      font-weight: 600;
    }

    h3::before {
      content: "";
      position: absolute;
      bottom: -2px;
      height: 6px;
      width: 100%;
      border-radius: 50px;
      transform: scaleX(0);
      transition: transform 0.2s linear;
    }

    .project-images {
      text-align: center;
      margin-top: 20px;
      padding: 30px 0px;
      max-width: 100%;
      margin: 42px auto;
      border-top: 1px solid lightgray;
      border-bottom: 1px solid lightgray;
    }

    .project-images img {
      max-width: 100%;
      height: auto;
      margin-bottom: 20px;
    }

    .contact-info {
      font-size: 11px;
    }

    .working-hours {
      margin-top: 10px;
    }

    .navbar {
      background-color: black;
    }

    .rating {
      display: inline-block;
      position: relative;
      height: 50px;
      line-height: 50px;
      font-size: 25px;
    }

    .rating label {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      cursor: pointer;
    }

    .rating label:last-child {
      position: static;
    }

    .rating label:nth-child(1) {
      z-index: 5;
    }

    .rating label:nth-child(2) {
      z-index: 4;
    }

    .rating label:nth-child(3) {
      z-index: 3;
    }

    .rating label:nth-child(4) {
      z-index: 2;
    }

    .rating label:nth-child(5) {
      z-index: 1;
    }

    .rating label input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }

    .rating label .icon {
      float: left;
      color: transparent;
    }

    .rating label:last-child .icon {
      color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
      color: #f1b434;
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
      color: #000;
      text-shadow: 0 0 5px #09f;
    }

    @media only screen and (min-width: 767px) {
      .profile-container {
        text-align: left;
        width: 55%;
        padding-top: 70px;
      }

      .img-prof {
        max-width: 100%;
        width: 190px;
        height: 190px;
        border-radius: 50%;
      }

      p {
        font-size: 16px;
      }

      b {
        font-size: 20px;
      }

      h2 {
        font-size: 40px;
      }

      .bdleft {
        border-left: 1px solid lightgray;
        padding-left: 25px;
      }
    }

    @media only screen and (min-width: 767px) and (max-width: 1366px) {
      .profile-container {
        text-align: left;
        width: 80%;
        padding-top: 70px;
      }
    }
  </style>
</head>

<body style="background-color: #f4f4f4;">

  <br>
  <div class="profile-container cos-div clearfix">
    <div class="row">
      <div class="col-md-5 text-center justify-content-center">
      <a href="../index.php"><button type="button" class="btn btn-dark btn-color1  btn-sm"><i class="fa-solid fa-house fa-xs"></i> &nbspHome</button></a>
        <button type="button" class="btn btn-dark btn-color1  btn-sm" data-bs-toggle="modal" data-bs-target="#update-data"><i class="fa-solid fa-pen-to-square"></i> &nbspEdit Profile</button>
        <?php
        if (isset($_SESSION['id'])) {
          $userID = $_SESSION['id'];

          // Query to fetch data from the service table
          $query_service = "SELECT * FROM service WHERE user_id = '$userID'";
          $query_run_service = mysqli_query($conn, $query_service);

          // Query to fetch data from the login table
          $query_login = "SELECT firstName, lastName, telNo, filename FROM login WHERE id = '$userID'";
          $query_run_login = mysqli_query($conn, $query_login);

          if ($query_run_service && $query_run_login) {
            // Fetch data from the login table 
            $loginData = mysqli_fetch_assoc($query_run_login);
            $firstName = $loginData['firstName'];
            $lastName = $loginData['lastName'];
            $telNo = $loginData['telNo'];
            $filenameProf = $loginData['filename'];


            // Fetch data from the service table for each service provider
            while ($serviceData = mysqli_fetch_assoc($query_run_service)) {
              $jobRole = $serviceData['jobRole'];
              $aboutme = $serviceData['aboutme'];
              $ExpYears = $serviceData['ExpYears'];
              $WorkDays = $serviceData['WorkDays'];
              $timeRange = $serviceData['timeRange'];
              $workAreas = $serviceData['workAreas'];
              $timeCall = $serviceData['timeCall'];
              $filenameImg = $serviceData['filename'];
        ?>
              <div><img class="img-prof" src="../profilePic/<?= $filenameProf ?>" alt="Profile Picture"></div>
              <div>
                <h6 style="font-weight: bold;">User Rating 80.0%</h6>
              </div>
              <div>
                <form class="rating">
                  <label>
                    <input type="radio" name="stars" value="1" />
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input type="radio" name="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input type="radio" name="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input type="radio" name="stars" value="4" checked />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input type="radio" name="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                </form>
              </div>
      </div>

      <div class="col-md-6 bdleft">
        <h2><?= $firstName ?>&nbsp;<?= $lastName ?></h2>
        <p><b><?= $jobRole ?> </b></p>
        <p><b>About Me:</b> <?= $aboutme ?></p>

        <div class="experience-info">
          <b><i class="fa-solid fa-briefcase"></i> Experience</b>
          <p class="x"><?= $ExpYears ?></p>
          <b><i class="fa-solid fa-calendar-days"></i> Working Days</b>
          <p class="x"><?= $WorkDays ?></p>
          <b><i class="fa-regular fa-clock"></i> Working Time</b>
          <p class="x"><?= $timeRange ?></p>
          <b><i class="fa-solid fa-location-dot"></i> Working Areas</b>
          <p class="x"><?= $workAreas ?></p>
          <b><i class="fa-solid fa-phone"></i> Best Time to Call</b>
          <p class="x"><?= $timeCall ?></p>
          <p><b><i class="fa-solid fa-mobile-screen-button"></i> Contact Number : <?= $telNo ?></b></p>
        </div>
      </div>
    </div>

    <div class="project-images row">
      <h2 style="font-size: 30px;">Recent Works</h2><br>
      <div class="col-md-6"><img src="serviceAdmin/uploads/<?= $filenameImg?>" alt="Project 1"></div>
    </div>
  </div>
<?php
            }
          } else {
              echo "user not found"
?>


<?php
          }
        } else {
          echo "Query execution failed.";
        }
?>

<br>

<section class="back-dark">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col mt-5">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="footerItem">Home</a></li>
          <li><a href="#" class="footerItem">Products</a></li>
          <li><a href="#" class="footerItem">Services</a></li>
          <li><a href="#" class="footerItem">About Us</a></li>
        </ul>
      </div>
      <div class="col mt-5">
        <h5>Products</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="footerItem">Furniture</a></li>
          <li><a href="#" class="footerItem">Electrical Appliances</a></li>
          <li><a href="#" class="footerItem">Ornaments</a></li>
          <li><a href="#" class="footerItem">Ceramic and Porcelain</a></li>
          <li><a href="#" class="footerItem">Hardware</a></li>
        </ul>
      </div>
      <div class="col mt-5">
        <h5>Services</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="footerItem">Architects</a></li>
          <li><a href="#" class="footerItem">Civil Engineers</a></li>
          <li><a href="#" class="footerItem">Masons</a></li>
          <li><a href="#" class="footerItem">Plumbers</a></li>
          <li><a href="#" class="footerItem">Painters</a></li>
          <li><a href="#" class="footerItem">Roofers</a></li>
          <li><a href="#" class="footerItem">Electricians</a></li>
          <li><a href="#" class="footerItem">Landscape Designers</a></li>
          <li><a href="#" class="footerItem">Vehicle Providers</a></li>
          <li><a href="#" class="footerItem">Machine Renters</a></li>
          <li><a href="#" class="footerItem">Delivery Providers</a></li>
        </ul>
      </div>

      <div class="col mt-5">
        <h5>Reach Us</h5>
        <form action="" method="post">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="Your Name" name="name">
            <label for="name">Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
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

<!-- modal itself -->
<div class="modal fade" id="update-data" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"><i class="fa-solid fa-pen-to-square"></i> &nbspEnter Details You Want to Change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="editProfile.php" method="post" enctype="multipart/form-data">

          <?php
          if (isset($_SESSION['id'])) {
            $userID = $_SESSION['id'];

            // Query for the first set of data
            $query_service = "SELECT jobRole, aboutme, ExpYears, WorkDays, timeRange, workAreas, timeCall, filename FROM service WHERE user_id = '$userID'";
            $query_run_service = mysqli_query($conn, $query_service);
            $item1 = mysqli_fetch_assoc($query_run_service);

            // Query for the second set of data
            $query_login = "SELECT firstName, lastName, telNo, filename FROM login WHERE id= '$userID'";
            $query_run_login = mysqli_query($conn, $query_login);
            $item2 = mysqli_fetch_assoc($query_run_login);

            if ($query_run_service && $query_run_login) {
              // Check if the user ID is found in the service table
              if (mysqli_num_rows($query_run_service) > 0) {
                // User ID found, display data
          ?>


                <input type="hidden" name="user_id" value="<?= $userID ?>">
                <div class="form-group mb-3">
                  <label for="formFile" class="col-form-label">Choose a profile picture</label>
                  <input class="form-control" type="file" name="file">
                  <?php if (isset($item2['filename'])) : ?>
                    <input type="text" readonly class="form-control-plaintext" value="<?= $item2['filename']; ?>">
                  <?php else : ?>
                    <input type="text" readonly class="form-control-plaintext" value="No profile picture available">
                  <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typefirstnameX">First Name</label>
                  <input type="text" class="form-control" name="fname" value="<?= $item2['firstName'] ?>">
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typelastnameX">Last Name</label>
                  <input type="text" class="form-control" name="lname" value="<?= $item2['lastName'] ?>">
                </div>

                <div class="form-group mb-3">
                  <div><label class="col-form-label" for="typejobRoleX">Select Job Role :</label></div>
                  <dvi>
                    <select class="form-select" aria-label="Select Job Role" name="jobRole" id="typejobRoleX">
                      <option selected><?= $item1['jobRole'] ?></option>
                      <option value="Architects">Architects</option>
                      <option value="CivilEngineers">Civil Engineers</option>
                      <option value="Masons">Masons</option>
                      <option value="Painters">Painters</option>
                      <option value="Plumbers">Plumbers</option>
                      <option value="Roofers">Roofers</option>
                      <option value="Electricians">Electricians</option>
                      <option value="LandscapeDesigners">Landscape Designers</option>
                      <option value="VehicleProviders">Vehicle Providers</option>
                      <option value="MachineRenters">Machine Renters</option>
                      <option value="DeliveryProviders">Delivery Providers</option>
                    </select>
                  </dvi>
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typeaboutmeX">About Me</label>
                  <textarea class="form-control" id="typeaboutmeX" name="aboutme"><?= $item1['aboutme'] ?></textarea>
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typeYearsX">Experience Years</label>
                  <input type="text" class="form-control" id="typeYearsX" name="ExpYears" value="<?= $item1['ExpYears'] ?>">
                </div>

                <div class="form-group mb-3">
                  <div class="col-form-label"><u>Select Working Days :</u></div>
                  <div style="margin-left: 100px;">
                    <?php
                    $workDaysArray = explode(',', $item1['WorkDays']);
                    ?>
                    <div class="form-check"><input type="checkbox" id="mon" name="WorkDays[]" value="Monday" class="form-check-input" <?php echo (in_array('Monday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="mon">Monday</label>
                    </div>
                    <div class="form-check"><input type="checkbox" id="tue" name="WorkDays[]" value="Tuesday" class="form-check-input" <?php echo (in_array('Tuesday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="tue">Tuesday</label>
                    </div>
                    <div class="form-check"><input type="checkbox" id="wed" name="WorkDays[]" value="Wednesday" class="form-check-input" <?php echo (in_array('Wendsday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="wed">Wednesday</label>
                    </div>
                    <div class="form-check"><input type="checkbox" id="thurs" name="WorkDays[]" value="Thursday" class="form-check-input" <?php echo (in_array('Thursday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="thurs">Thursday</label>
                    </div>
                    <div class="form-check"><input type="checkbox" id="fri" name="WorkDays[]" value="Friday" class="form-check-input" <?php echo (in_array('Friday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="fri">Friday</label>
                    </div>
                    <div class="form-check"><input type="checkbox" id="sat" name="WorkDays[]" value="Saturday" class="form-check-input" <?php echo (in_array('Saturday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="sat">Saturday</label>
                    </div>
                    <div class="form-check"><input type="checkbox" id="sun" name="WorkDays[]" value="Sunday" class="form-check-input" <?php echo (in_array('Sunday', $workDaysArray) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="sun">Sunday</label>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typeTimeRange">Enter Working Time Range (Ex : 8.00AM - 5.00PM)</label>
                  <input type="text" class="form-control" id="typeTimeRangeX" name="timeRange" value="<?= $item1['timeRange'] ?>">
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typeWorkAreasX">Enter Working Areas (One or More)</label>
                  <input type="text" class="form-control" id="typeWorkAreasX" name="workAreas" value="<?= $item1['workAreas'] ?>">
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="typeCallX">Enter Best Time to Call (Ex : 6.00PM - 10.00PM)</label>
                  <input type="text" class="form-control" id="typeCallX" name="timeCall" value="<?= $item1['timeCall'] ?>">
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="telNo">Phone Number</label>
                  <input type="text" id="telNo" class="form-control" name="telNo" value="<?= $item2['telNo'] ?>">
                </div>

<div class="form-group mb-3">
    <label for="formFileW" class="col-form-label">Upload Your Recent Work's Images</label>
    <input class="form-control" type="file" id="formFileW" name="workImg">
    <?php if (isset($item1['filename'])) : ?>
        <input type="text" readonly class="form-control-plaintext" id="formFileWValue" value="<?= $item1['filename']; ?>">
    <?php else : ?>
        <input type="text" readonly class="form-control-plaintext" id="formFileWValue" value="No recent work image available">
    <?php endif; ?>
</div>



                <?php
              } else {
                // User ID not found in service table, insert it
                $query_insert_service = "INSERT INTO service (user_id, jobRole) VALUES ('$userID','Architect')";
                $query_run_insert_service = mysqli_query($conn, $query_insert_service);

                if ($query_run_insert_service) {
                  // Insertion successful, display the form
                ?>
                  <input type="hidden" name="user_id" value="<?= $userID ?>">
                  <div class="form-group mb-3">
                    <label for="formFile" class="col-form-label">Choose a profile picture</label>
                    <input class="form-control" type="file" id="formFile1" name="file">
                    <?php if (isset($item2['filename'])) : ?>
                      <input type="text" readonly class="form-control-plaintext" id="formFile1" value="<?= $item2['filename']; ?>">
                    <?php else : ?>
                      <input type="text" readonly class="form-control-plaintext" id="formFile1" value="No profile picture available">
                    <?php endif; ?>
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typefirstnameX">First Name</label>
                    <input type="text" id="typefirstnameX" class="form-control" name="fname" value="<?= $item2['firstName'] ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typelastnameX">Last Name</label>
                    <input type="text" id="typelastnameX" class="form-control" name="lname" value="<?= $item2['lastName'] ?>">
                  </div>

                  <div class="form-group mb-3">
                    <div><label class="col-form-label" for="typejobRoleX">Select Job Role :</label></div>
                    <dvi>
                      <select class="form-select" aria-label="Select Job Role" name="jobRole" id="typejobRoleX">
                        <option selected><?= isset($item1['jobRole']) ?></option>
                        <option value="Architects">Architects</option>
                        <option value="CivilEngineers">Civil Engineers</option>
                        <option value="Masons">Masons</option>
                        <option value="Painters">Painters</option>
                        <option value="Plumbers">Plumbers</option>
                        <option value="Roofers">Roofers</option>
                        <option value="Electricians">Electricians</option>
                        <option value="LandscapeDesigners">Landscape Designers</option>
                        <option value="VehicleProviders">Vehicle Providers</option>
                        <option value="MachineRenters">Machine Renters</option>
                        <option value="DeliveryProviders">Delivery Providers</option>
                      </select>
                    </dvi>
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typeaboutmeX">About Me</label>
                    <textarea class="form-control" id="typeaboutmeX" name="aboutme"><?= isset($item1['aboutme']) ?></textarea>
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typeYearsX">Experience Years</label>
                    <input type="text" class="form-control" id="typeYearsX" name="ExpYears" value="<?= isset($item1['ExpYears']) ?>">
                  </div>

                  <div class="form-group mb-3">
                    <div class="col-form-label"><u>Select Working Days :</u></div>
                    <div style="margin-left: 100px;">
                      <?php
                      $workDaysArray = explode(',', $item1['WorkDays']);
                      ?>
                      <div class="form-check"><input type="checkbox" id="mon" name="WorkDays[]" value="Monday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Monday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="mon">Monday</label>
                      </div>
                      <div class="form-check"><input type="checkbox" id="tue" name="WorkDays[]" value="Tuesday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Tuesday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="tue">Tuesday</label>
                      </div>
                      <div class="form-check"><input type="checkbox" id="wed" name="WorkDays[]" value="Wednesday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Wendsday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="wed">Wednesday</label>
                      </div>
                      <div class="form-check"><input type="checkbox" id="thurs" name="WorkDays[]" value="Thursday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Thursday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="thurs">Thursday</label>
                      </div>
                      <div class="form-check"><input type="checkbox" id="fri" name="WorkDays[]" value="Friday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Friday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="fri">Friday</label>
                      </div>
                      <div class="form-check"><input type="checkbox" id="sat" name="WorkDays[]" value="Saturday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Saturday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="sat">Saturday</label>
                      </div>
                      <div class="form-check"><input type="checkbox" id="sun" name="WorkDays[]" value="Sunday" class="form-check-input" <?php echo (isset($workDaysArray) && in_array('Sunday', $workDaysArray) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="sun">Sunday</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typeTimeRange">Enter Working Time Range (Ex : 8.00AM - 5.00PM)</label>
                    <input type="text" class="form-control" id="typeTimeRangeX" name="timeRange" value="<?= isset($item1['timeRange']) ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typeWorkAreasX">Enter Working Areas (One or More)</label>
                    <input type="text" class="form-control" id="typeWorkAreasX" name="workAreas" value="<?= isset($item1['workAreas']) ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="typeCallX">Enter Best Time to Call (Ex : 6.00PM - 10.00PM)</label>
                    <input type="text" class="form-control" id="typeCallX" name="timeCall" value="<?= isset($item1['timeCall']) ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="telNo">Phone Number</label>
                    <input type="text" id="telNo" class="form-control" name="telNo" value="<?= isset($item2['telNo']) ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label for="formFileW" class="col-form-label">Upload Your Recent Work's Images</label>
                    <input class="form-control" type="file" id="formFileW" name="workImg">
                    <input type="text" readonly class="form-control-plaintext" id="formFile" value="<?= $item1(['filename']); ?>">
                  </div>

          <?php
                } else {
                  // Insertion failed
                  echo "Data insert failed";
                }
              }
            } else {
              // Multi-query execution failed
              echo "Query execution failed";
            }
          } else {
            echo "User ID not found in session";
          }
          ?>

      </div>

      <div class="modal-footer">
        <button type="submit" name="update_btn" class="btn btn-dark btn-color1  btn-sm">Save Changes</button>
        <button class="btn btn-dark btn-color1  btn-sm" data-dismiss="modal">Close</button>

      </div>
      </form>
    </div>
  </div>
</div>
</div>
</body>
</html>