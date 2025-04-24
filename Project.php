<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require "db.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
}

?>

<head>
<title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/project1.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">
  <style>



  </style>

</head>
<header>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="images/city.mp4" type="video/mp4">
  </video>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top p-2 fs-4  ">
    <div class="container-fluid  ">
      <a class="navbar-brand fs-2 text-white" style="font-weight:800;" href="Home.php">3Helazel</p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse show d-flex justify-content-end " id="navbarNavAltMarkup">
          <div class="navbar-nav text-center">
            <a class="nav-link active text-white mx-4 txt display-nav" aria-current="page" href="home.php">HOME</p>
              <a class="nav-link text-white mx-4 display-nav" href="about.php">ABOUT</p>
                <a class="nav-link text-white mx-4 display-nav" href="Profiles.php">PROFILES</p>
                  <a class="nav-link  mx-4 display-nav" style="color:#ffc5aa" href="Portfolio.php">PORTFOLIO</p>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                      echo "<a class='nav-link mx-4 display-nav'href='compte.php' style='color: rgb(224, 107, 11);font-size:14pt;text-transform: uppercase;'>" . $_SESSION['username'] . "</a>";
                    } else {
                      echo '<a class="btn-navbar text-black display-nav mx-5" href="login.php">LOGIN</a>';

                    } ?>
          </div>
        </div>
    </div>
  </nav>
  <div class="container  h-100 w-100 ">
    <div class="d-flex mt-5 h-100  w-100 text-sm-start  p-5 ">
      <div class="w-50 text-white">
        <p class=" mt-5 ps-5 " style="font-weight:800;font-size:20pt;">OUR PROJECTS/<?php echo $_SESSION["project"] ?>
        </p>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
          $('.navbar').removeClass('bg-dark').addClass('bg-transparent').fadeIn(500);
        } else {
          $('.navbar').removeClass('bg-transparent').addClass('bg-dark').fadeIn(400);
        }
      });
    });
  </script>
</header>
<?php
$project = $_SESSION["project"];

?>

<body>
  <form method="POST">
    <div class="d-flex justify-content-center pt-5">
      <div class="d-flex flew-row gap-3">
        <div class="d-flex flew-row  flex-wrap justify-content-center">
          <?php
          $sql = "SELECT * from projects where category='$project' ORDER BY ProjectName limit 10;";
          $result = mysqli_query($conn, $sql);
          while ($row = $result->fetch_assoc()) {
            echo '<div class="container overflow-hidden pb-3 ">
          <a href="Project_arch.php?pid=' . urlencode($row["ProjectId"]) . '" class="overflow-hidden p-0 border-0">
               <img style="transition: all .8s ease-in-out;" src="images/' . $row["Category"] . '/ProjectImage/' . $row["ProjectImage"] . '" class="image-container" />
          </a>
          <div class="bottom-left text-black px-2">' . $row["ProjectName"]  . '</div>
      </div>';
          }
          ; ?>
        </div>
      </div>
    </div>
    </div>
  </form>
  <script>
    $(document).ready(function () {
      $('.image-container').hover(
        function () {
          $(this).css('transform', 'scale(1.2)'); // increase scale on hover
        },
        function () {
          $(this).css('transform', 'scale(1)'); // revert scale on hover out
        }
      );
    });
  </script>
</body>

<footer class="text-white text-center text-lg-start bg-dark t-5  d-flex justify-content-center">
  <div class="d-flex flex-column">
    <div class="container p-4 ">
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
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);width:100%!important;">
      © 2015 Copyright:
      <a class="text-white" href="home.php">3helazel.com</a>
    </div>
    </div>
  </footer>

</html>