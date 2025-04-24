<html>

<?php
session_start();
require 'db.php';
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query_string = parse_url($url, PHP_URL_QUERY);
parse_str($query_string, $params);
if (isset($params['pid'])) {
  $pid = $params['pid'];
  $encoded_pid = urlencode($pid);
} else {
  echo "Architect ID not found in the =URL.";
}
?>
<head>
<title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/Project_arch.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <style>
    html {
      font-size: 16px !important;
      font-family: "Noto Sans Display", sans-serif;
      font-optical-sizing: auto;
      font-weight: 700;
      font-style: normal;
      font-variation-settings:
        "wdth" 100;
    }

    textarea {
      width: 90%;
      height: 150px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-shadow: inset 0 1px 3px #ddd;
      font-size: 16px;
      resize: vertical;
      margin: 10px 0;
    }

    button {
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>

</head>


<header>
  <nav class="navbar navbar-expand-lg navbar-light  p-2 fs-4 bg-dark fixed-top">
    <div class="container-fluid ">
      <a class="navbar-brand fs-2 text-white" style="font-weight:800;" href="Home.php">3Helazel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse show d-flex justify-content-end " id="navbarNavAltMarkup">
        <div class="navbar-nav text-center">
          <a class="nav-link active  mx-4 txt display-nav text-white" aria-current="page" href="Home.php">HOME</a>
          <a class="nav-link text-white mx-4 display-nav" href="about.php">ABOUT</a>
          <a class="nav-link text-white mx-4 display-nav " href="Profiles.php">PROFILES</a>
          <a class="nav-link  mx-4 display-nav" href="Portfolio.php" style="color:#ffc5aa">PORTFOLIO</a>
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo "<a class='nav-link mx-4 display-nav'href='compte.php' style='color: rgb(224, 107, 11);font-size:14pt;text-transform: uppercase;'>" . $_SESSION['username'] . "</a>";
          } else {
            echo '<a class="btn-navbar text-black display-nav mx-5" href="login.php">LOGIN</a>';

          } ?>
        </div>
      </div>
    </div>
  </nav>
</header>
<hr style="height:60px">




<body >
  <?php

            $sql = "SELECT 
          projects.ProjectName AS ProjectName,
          projects.ProjectImage AS ProjectImage,
          projects.Category AS Category,
          architects.ProfileImage AS ProfileImage,
          projects.architectid as id,
          architects.Name AS Name,
          projects.ProjectId AS ProjectId
          FROM
          projects,architects
          where 
          projects.ProjectId='$pid' AND projects.architectid=architects.architectid;
          ";
  $result = $conn->query($sql);
  $message = "";
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $a_ID = $row["id"];
      if (!isset($pid)) {
        echo "Project ID not found.";
        // You might want to redirect the user to an error page here
      } else {
        if (isset($_POST["rate"])) {
          $rating = $_POST["rate"];

          // Update the rating in the database
          $sql = "UPDATE projects SET reviews=$rating WHERE ProjectId='$pid';";
          if ($conn->query($sql) === TRUE) {
            $message = "Your rating is sent!";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        // Your existing code to display the project details
      }



      echo '
            <div class="w-50 text-dark">
            <p class=" mt-5 pb-5 ps-5 " style="font-weight:800;font-size:20pt;">OUR PROJECTS/' . $row['Category'] . '/' . $row['ProjectName'] . '
            </p>
            </div>

              <div class="d-flex flex-row container gap-5">
                      <img src="images/' . $row['Category'] . '/projectimage/' . $row['ProjectImage'] . '" style="width:900;height:600;";>
                      <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-column gap-3">
                          <div class="d-flex flex-row gap-3">
                            <img src="' . $row['ProfileImage'] . '"style="widht:200;height:200;">
                            <div class="d-flex flex-column">
                            <p class="h1">' . $row['Name'] . '</p>
                            <p class="h4" style="color:orange;">' . $row['Category'] . '</p>
                          </div>
                        </div>
                        <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' . ?pid= ' . $pid . '; ">
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                        <input type="submit" class="btn btn-dark" value="Submit Rating">
                      </form>
                      <h4 style="color:red;">' . $message . '</h4>
                      </div>
              </div>
              </div>
';
    }
  }


  ?>
<h2 class="p-5">More projects by architect:</h2>
<div class="container d-flex flex-row gap-5 flex-wrap justify-content-center ">
<?php
      // Get the current URL from the address bar
      

      // SQL to fetch all profiles
      $sql = "SELECT 
            ProjectImage,
            Category,
            ProjectId,
            ProjectName
            FROM
            projects
            where 
            architectID = '$a_ID'
            LIMIT
            9;";
      $result = $conn->query($sql);
      // Check if we have results
      if ($result->num_rows) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
        
            echo ' 
            <a href="Project_arch.php?pid=' . urlencode($row["ProjectId"]) . '" class="overflow-hidden p-0 border-0">
                 <img style="transition: all .8s ease-in-out; height:300px;width:400px;" src="images/' . $row["Category"] . '/ProjectImage/' . $row["ProjectImage"] . '" class="image-container" />
            </a>
    ';
    
        }
      }
      ?>
      </div>
</body>
<hr style="height:70px;color:transparent;">

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