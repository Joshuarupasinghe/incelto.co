<!DOCTYPE html>
<html lang="en">
<?php
include("php/user_session.php");
include("DBconnection/connect.php");
?>

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
    <link rel="stylesheet" href="css/main.css">

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
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="productslist.php">Products&nbsp;</a></li>
                    <li class="nav-item"><a class="nav-link active" href="services.php">Services&nbsp;</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutUs.html">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactUs.html">Contact Us</a></li>
                </ul>
                <a href="new-login.html">
                    <div class="btn btn-dark btn-color1  btn-sm">Login/Sign Up</div>
                </a>
            </div>
    </nav>
    <br>
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
            // Fetch data from the login table (since this information is common for both service providers)
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

                <div class="profile-container cos-div clearfix">
                    <div class="row">
                        <div class="col-md-5 text-center justify-content-center">
                            <div><img class="img-prof" src="profilePic/<?= $filenameProf ?>" alt="Profile Picture"></div>
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
                                <p class="x"><?= $ExpYears ?> Years Experience</p>
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
                        <div class="col-md-6"><img src="serviceAdmin/uploads/<?= $filenameImg ?>" alt="Project 1"></div>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            User not found

    <?php
        }
    } else {
        echo "Query execution failed.";
    }
    ?>
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
    </div>

</body>

</html>