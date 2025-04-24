<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require "db.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
} ?>
<html>

<head>
<title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/about1.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

  <style>
    html,header,body {
      font-size: 16px !important;
      font-family: "Noto Sans Display", sans-serif;
      font-optical-sizing: auto;
      font-weight: 700;
      font-style: normal;
      font-variation-settings:
        "wdth" 100;
    }
  </style>

</head>
<style>

</style>
</head>
<header>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top p-2    ">
    <div class="container-fluid  ">
      <a class="navbar-brand fs-2 text-black" style="font-weight:800;" href="Home.php">3Helazel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse show d-flex justify-content-end " id="navbarNavAltMarkup">
        <div class="navbar-nav text-center">
          <a class="nav-link active text-white mx-4 txt display-nav" aria-current="page" href="Home.php"
            style=''>HOME</a>
          <a class="nav-link  mx-4 display-nav" href="about.php"
            style="color:#ffc5aa ;">ABOUT</a>
          <a class="nav-link text-white mx-4 display-nav" href="Profiles.php" style=''>PROFILES</a>
          <a class="nav-link text-white mx-4 display-nav" href="Portfolio.php" style=''>PORTFOLIO</a>
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo "<a class='nav-link mx-4 display-nav'href='compte.php' style='color: rgb(224, 107, 11);text-transform: uppercase;'>" . $_SESSION['username'] . "</a>";
          } else {
            echo '<a class="btn-navbar text-black display-nav mx-5" href="login.php">LOGIN</a>';

          } ?>
        </div>
      </div>
    </div>
  </nav>
</header>

<body>
  <div class="d-flex" style="height:100%;">
    <div class="left-content p1">
      <h1>What We Provide</h1>
      <br>
      <div class="section">
        <h2>01 Consultation</h2>
        <p>We begin by understanding your needs and vision.</p>
      </div>
      <div class="section">
        <h2>02 Conceptual Design</h2>
        <p>Our team develops innovative design concepts tailored to your project.</p>
      </div>
      <div class="section">
        <h2>03 Refinement</h2>
        <p>We work closely with you to refine the design and ensure it meets your expectations.</p>
      </div>
      <div class="section">
        <h2>04 Construction</h2>
        <p>Our architects oversee the construction process to ensure the final result exceeds your expectations.
        </p>
      </div>
      <a class="btn-navbar text-black display-nav my-5" href="portfolio.php">CHECK OUR PROJECTS -></a>
    </div>
    <div class="right-content">
      <video id="video" width="100%" height="100%" autoplay loop muted>
        <source src="vid2.mp4" type="video/mp4">
      </video>
    </div>
  </div>
  <script>
    const video = document.getElementById("video");

    video.addEventListener("loadedmetadata", function () {
      this.currentTime = 1;
      this.play();
    });
  </script>

</body>
<footer class="text-white text-center text-lg-start bg-dark t-5">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row mt-4">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">About company</h5>


        <div class="mt-4">
          <!-- Facebook -->
          <a type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-facebook-f"></i></a>
          <!-- Dribbble -->
          <a type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-dribbble"></i></a>
          <!-- Twitter -->
          <a type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-twitter"></i></a>
          <!-- Google + -->
          <a type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-google-plus-g"></i></a>
          <!-- Linkedin -->
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4 pb-1">Search something</h5>

        <div class="form-outline form-white mb-4">
          <input type="text" id="formControlLg" class="form-control form-control-lg" />
          <label class="form-label" for="formControlLg">Search</label>
        </div>

        <ul class="fa-ul" style="margin-left: 1.65em;">
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">les berges du lac I</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">3helazel@gmail.com</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+216 98315478</span>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Opening hours</h5>

        <table class="table text-center text-white">
          <tbody class="fw-normal">
            <tr>
              <td>Mon - Thu:</td>
              <td>8am - 9pm</td>
            </tr>
            <tr>
              <td>Fri - Sat:</td>
              <td>8am - 1am</td>
            </tr>
            <tr>
              <td>Sunday:</td>
              <td>9am - 10pm</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2015 Copyright:
    <a class="text-white" href="home.php">3helazel.com</a>
  </div>
  <!-- Copyright -->
</footer>

</html>