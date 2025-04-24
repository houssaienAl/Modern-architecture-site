<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require "db.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
}
$sql = "SELECT * from architects
order by reviews desc
limit 3;
";
$result = $conn->query($sql);
$i = 1;

while ($row = $result->fetch_assoc()) {
  // Generate dynamic variable names
  ${"Name$i"} = $row['Name'];
  ${"ProfileImage$i"} = $row['ProfileImage'];
  ${"A_id$i"} = $row['ArchitectID'];

  // Increment counter
  $i++;
}

?>

<head>
  <title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/Home.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <link rel="stylesheet" type="text/css" href="css/carousel.css" />
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">
  <!-- Include Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Include Leaflet JavaScript -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Add some CSS for the map container -->
  <style>
    html,
    main {
      padding: 0;
      margin: 0;
      font-size: 30px;
      height: 100%;
      box-sizing: border-box;
      font-family: "Noto Sans Display", sans-serif;
      font-size: 1rem;
      line-height: 1.4;
      color: white;
      transition: background-color 150ms ease-out, color 150ms ease-out;
      font-weight: 600;
    }

    html {

      font-family: "Noto Sans Display", sans-serif;
      font-optical-sizing: auto;
      font-weight: 700;
      font-style: normal;
      font-variation-settings:
        "wdth" 100;
    }
  </style>

</head>
<header>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="images/FILE.mp4" type="video/mp4">
  </video>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top p-2 fs-4  ">
    <div class="container-fluid  ">
      <a class="navbar-brand fs-2 text-white" style="font-weight:800;" href="Home.php">3Helazel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse show d-flex justify-content-end " id="navbarNavAltMarkup">
        <div class="navbar-nav text-center">
          <a class="nav-link active  mx-4 txt display-nav" aria-current="page" style="color:#ffc5aa" href="home.php">HOME</a>
          <a class="nav-link text-white mx-4 display-nav" href="about.php">ABOUT</a>
          <a class="nav-link text-white mx-4 display-nav" href="Profiles.php">PROFILES</a>
          <a class="nav-link text-white mx-4 display-nav" href="Portfolio.php">PORTFOLIO</a>
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo "<a class='nav-link mx-4 display-nav'href='compte.php' style='color: rgb(224, 107, 11);font-size:14pt;text-transform: uppercase;'>" . $_SESSION['username'] . "</a>";
          } else {
            echo '<a class="btn-navbar text-black display-nav mx-5" href="login.php">LOGIN</a>';

          } ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="container h-100 w-100 " style="top:30%">
    <div class="d-flex h-50  w-100 text-sm-start align-items-center p-5 ">
      <div class="w-70 text-white">
        <main class="scene">
          <div class="actor">
            <div class="actor__prefix">-</div>
            <div id="vader" class="actor__content"></div>
          </div>

        </main>
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
  <script src="https://cdn.jsdelivr.net/npm/theaterjs@latest"></script>
  <script>
    var theater = theaterJS()

    theater

      .on('type:end, erase:end', function () {
        theater.getCurrentActor().$element.classList.remove('actor__content--typing');
      });

    theater
      .addActor('vader', { speed: 0.8, accuracy: 0.6 })
      .addScene('vader:WHERE VISION MEETS STRUCTURE', 600)

      .addScene(theater.replay.bind(theater));
  </script>
</header>

<body>
  
<div class="d-flex flex-row">
    <img src="images/immg.jpg" style="height:1000px;width:588px;border-radius: 0px;">
    <div class="p-5">
      <div >
      <p style="font-weight:700;font-size:15pt;">Our goal:</p>
      <p style="font-weight:600;font-size:70pt;">Embracing architects and promoting quality architecture. </p>
      </div>
      <div style="margin-top: 12rem !important;">
      <p style="font-weight:400;font-size:40pt;">We are a forward-thinking Livery Company that achieves its aims through education, mentoring, awards and philanthropy.</p>
      <a class="btn-navbar text-black display-nav  " href="portfolio.php" >SEE OUR WORK-></a>
      </div>
    </div>

    </div>
<div class="container d-flex flex-column py-5">
    <p class="text-black "style="text-align:left;font-weight:700;font-size:20pt;">Membership</p>
    <p class="text-black"style="text-align: left;font-size:50pt;font-weight:600">Welcoming a diverse membership with a passion for architecture.</p>
    <p class="text-black"style="text-align: left;font-size:50pt;font-weight:600">If your are passionate about the built environment, you can apply to join as a member.</p>
    <a class="btn-navbar text-black display-nav w-25 " href="login.php" >LOGIN-></a>


  </div>
  <div class=" d-flex flex-row ">
    <div id="map" class="w-75" style="height:700px">
    </div>
    <div class="d-flex align-items-start flex-column w-75 p-5">
      <h4 class="text-black pb-2">ABOUT</h4>
      <p class="text-black pb-2" style="text-align: left;font-size:70pX;font-weight:620;">3helazel is a dynamic company
        dedicated to bringing people's dream designs to life.
        
      </p>
      <a class="btn-navbar text-black display-nav " href="about.php" style="top:150px">LEARN MORE -></a>
    </div>

  </div>
  <hr>


  <h1 class="d-flex justify-content-center my-5" style="color: rgb(224, 107, 11);">OUR TOP 3 BEST ARCHITECTS</h1>
  <div class="container container1 my-5">
    <input type="radio" name="slider" id="item-1" checked>
    <input type="radio" name="slider" id="item-2">
    <input type="radio" name="slider" id="item-3">
    <div class="cards">
      <label class="card" for="item-1" id="song-1">
        <div class="container d-flex flex-column justify-content-center gab-3 my-5">
          <h3 class="d-flex justify-content-center text-dark"><?php echo $Name1; ?></h3>
          <div class="d-flex justify-content-center"> <img src="<?php echo $ProfileImage1 ?>"
              style="width:600px;height:600px;">
          </div>
          <a href="<?php echo "Person.php?architect_id=" . urlencode($A_id1) . ""; ?>  "
            class="btn btn-dark centered">SEE
            MORE</a>
        </div>
      </label>
      <label class="card" for="item-2" id="song-2">
        <div class="container d-flex flex-column justify-content-center gab-3 my-5">

          <h3 class="d-flex justify-content-center text-dark"><?php echo $Name2; ?></h3>
          <div class="d-flex justify-content-center"> <img src="<?php echo $ProfileImage2 ?>"
              style="width:600px;height:600px;">
            <a href="<?php echo "Person.php?architect_id=" . urlencode($A_id2) . ""; ?>  "
              class="btn btn-dark centered">SEE
              MORE</a>
          </div>
        </div>
      </label>
      <label class="card" for="item-3" id="song-3">
        <div class="container d-flex flex-column justify-content-center gab-3 my-5">

          <h3 class="d-flex justify-content-center text-dark"><?php echo $Name3; ?></h3>
          <div class="d-flex justify-content-center"> <img src="<?php echo $ProfileImage3 ?>"
              style="width:600px;height:600px;">
          </div>

          <a href="<?php echo "Person.php?architect_id=" . urlencode($A_id3) . ""; ?>  "
            class="btn btn-dark centered">SEE
            MORE</a>
        </div>
      </label>
    </div>
  </div>
  <hr style="height:70px;color:transparent;">

  <script>
    // Initialize and add the map
    var map = L.map('map').setView([36.83784, 10.24752], 18); // Set the initial center and zoom level

    // Add the base map tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add markers for the Statue of Liberty, Empire State Building, and Central Park
    var statueMarker = L.marker([36.83784, 10.24752]).addTo(map);
    statueMarker.bindPopup('<b>3helazel</b><br>tunisia,tunis').openPopup();
    hljs.initHighlightingOnLoad();

$('.hero__scroll').on('click', function (e) {
  $('html, body').animate({
    scrollTop: $(window).height()
  }, 1200);
});
  </script>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- <script src="http://localhost:3002/dist/aos.js"></script> -->

  <script>
    AOS.init({
      easing: 'ease-out-back',
      duration: 1000
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


<!-- End of .container -->