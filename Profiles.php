<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require "db.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // You can add more user-specific content here
}


if (isset($_POST['bsubmit'])) {
  if ($_FILES['userfile']['error'] == 0) { // pas d'erreur
    foreach ($_FILES['userfile'] as $prop => $val) {
      $uploadDirectory = "images/"; // You should replace this with the actual directory path on your server
      $filePath = $uploadDirectory . basename($_FILES['userfile']['name']);
      echo $filePath;
      $name_arc = $_POST['name_arc'];
      $name_cat = $_POST['name_cat'];
      $name_work = $_POST['name_work'];
      $sql = "INSERT INTO architects(Name,projectcategory,workedwith,profileimage)
      values('$name_arc','$name_cat','$name_work','$filePath');";
      $result = $conn->query($sql);
    }
    // vérification que fichier sur le serveur
    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
      echo 'Le fichier a bien été uploadé sur le serveur.';
    }
    $target_dir = "images/Profiles/"; // Specify the directory where files should be saved
    $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["userfile"]["name"])) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  } else {
    echo 'Erreur ! Code d\'erreur #' . $_FILES['userfile']['error'];
  }


}

?>

<head>
  <title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/profiles.css" />
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
      font-variation-settings: "wdth" 100;
    }

    .popup-wrapper1 {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      z-index: 999;
      display: none;
    }
  </style>
</head>

<body style="background-color:FFE0B5">
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
            <a class="nav-link  mx-4 display-nav" style="color:#ffc5aa" href="Profiles.php">PROFILES</a>
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
  </header>
  <hr style="height:90px;">
  <p class=" mt-5 ps-5 " style="font-weight:800;">OUR PROFILES/ </p>

  <div class="d-flex justify-content-around ">
    <div></div>
    <?php
    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) && ($_SESSION['username'] == "admin")) {

      echo '<div class="d-flex justify-content-center">';
      echo '   <a class="btn btn-secondary"onclick="togglePopup()" name="addprofile">ADD PROFILE</a>';
      echo '</div>';
    }

    ?>
    <div class=" d-flex  ps-5 flex-row">
      <form action="" method="GET">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
          <option value="Reviews">Reviews</option>
          <option value="ArchitectName">Name</option>
          <option value="ProjectCount">ProjectCount</option>
        </select>
        <input type="submit" class="btn btn-dark" value="Sort">
      </form>
    </div>
  </div>
  <div class="popup-wrapper1 ">
    <div>
      <section class="vh-100" style="background-color:transparent;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <form enctype="multipart/form-data" action="#" method="POST">
              <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                  <div class="card-body p-md-5">
                    <div class="row d-flex justify-content-center">
                      <div onclick="togglePopup()" class="btn-close btn-close-black close"></div>
                      <h3 class="d-flex justify-content-center flex-row pb-5">ADD PROFILE:</h3>
                      <div class="d-flex flex-row mb-5 d-flex justify-content-between">
                        <h5 class="me-5 ">Add name:</h5>
                        <input class="d-flex justify-content-center" style="width:60%;" name="name_arc">
                      </div>
                      <div class="d-flex flex-row pb-5  d-flex justify-content-between ">
                        <h5 class="me-5">Add category:</h5>
                        <input style="width:60%;" name="name_cat">
                      </div>
                      <div class="d-flex flex-row pb-5 d-flex justify-content-between">
                        <h5 class="pe-5 ">Worked with who:</h5>
                        <input style="width:60%;" name="name_work">
                      </div>
                      <div class="d-flex flex-row pb-5 d-flex justify-content-between">
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                        <h5 class="pe-5">Choose a profile image :</h5> <input name="userfile" type="file" /> <input
                          class="btn btn-dark" type="submit" name="bsubmit" value="Send file" />
                        <br /><br />

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="container my-5 py-5 d-flex justify-content-center">

    <div class="d-flex flex-column">

      <?php
      require "db.php";
      $sort = isset($_GET['sort']) ? $_GET['sort'] : 'Reviews';
      $sql = "SELECT
      ArchitectName,
      ArchitectImage,
      ArchitectID,
      Reviews,
      WorkedWith,
      ProjectCategory,
      ProjectImage,
      ProjectId,
      ProjectCount
  FROM (
      SELECT
          a.Name AS ArchitectName,
          a.ProfileImage AS ArchitectImage,
          a.ArchitectId AS ArchitectID,
          a.WorkedWith AS WorkedWith,
          a.reviews AS Reviews,
          a.ProjectCategory AS ProjectCategory,
          p.ProjectImage AS ProjectImage,
          p.ProjectId AS ProjectId,
          ROW_NUMBER() OVER(PARTITION BY a.Name ORDER BY p.ProjectId ASC) AS rn,
          (SELECT COUNT(*) FROM projects WHERE architectid = a.ArchitectID) AS ProjectCount
      FROM
          projects p
      LEFT JOIN architects a ON a.ArchitectId = p.ArchitectID
  ) t
  WHERE
      t.rn = 1  
  ORDER BY
      $sort DESC;
  ";
      $result = $conn->query($sql);
      // Check if we have results
      if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
          $id = $row["ArchitectID"];
          echo "<div class='d-flex flex-row'>";
          echo "<div class'd-flex flex-column p-1'>";
          if ($row["ProjectCategory"] == "Commercial") {
            echo ' <img src="images/Commercial/ProjectImage/' . $row["ProjectImage"] . '"  class="img-fluid img-dff pb-1">';

          } else if ($row["ProjectCategory"] == "Industrial") {

            echo ' <img src="images/Industrial/ProjectImage/' . $row["ProjectImage"] . '" class="img-fluid img-dff pb-1">';


          } else {
            echo ' <img src="images/Residential/ProjectImage/' . $row["ProjectImage"] . '" class="img-fluid img-dff pb-1">';


          }
          echo "</div>";
          echo "<div class='px-5 d-flex flex-column'>";
          echo "<div class='d-flex flex-row'>";
          echo '<a href="Person.php?architect_id=' . $row["ArchitectID"] . '">';
          echo '<img src="' . $row["ArchitectImage"] . '"  class="card-img-top profile-img d-block pe-1">';
          echo '</a>';
          echo "<div class='d-flex flex-column ms-3'>";
          echo "<p class='text-name'>" . $row["ArchitectName"] . "</p>";
          echo "<p class='h2'>" . $row["ProjectCategory"] . "</p>";
          echo "</div>";
          echo "</div>";
          echo "<div class='d-flex flex-column pt-3'>";
          echo "<div class='d-flex flex-row'>";
          echo "<p class='text-work pe-2'>Expertise:</p>";
          echo "<p class='text-work2'>" . $row["ProjectCategory"] . "</p>";
          echo "</div>";
          echo "<div class='d-flex flex-row'>";
          echo "<p class='text-work pe-2'>Worked with:</p>";
          echo "<p class='text-work2'>" . $row["WorkedWith"] . "</p>";
          echo "</div>";
          echo "<div class='d-flex flex-row'>";
          echo "<p class='text-work pe-2'>Number of projects:</p>";
          echo "<p class='text-work2'>" . $row["ProjectCount"] . "</p>";
          echo "</div>";
          if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) && ($_SESSION['username'] == "admin")) {
            echo '<form method="post"><div>
          <input type="hidden" name="Aid" value="' . $row['ArchitectID'] . '">
          <button class="btn btn-danger" name="delete">Delete architect</button></div></form>';
           
          }
          ;
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
        }
      } else {
        echo "0 results";
      }
      if (isset($_POST["delete"])) {
        $id = $_POST["Aid"];

        // First, delete associated projects
        $sql_delete_projects = "DELETE FROM projects WHERE ArchitectID = $id";
        if ($conn->query($sql_delete_projects) === TRUE) {
          // Then, delete the architect
          $sql_delete_architect = "DELETE FROM architects WHERE ArchitectID = $id";
          if ($conn->query($sql_delete_architect) === TRUE) {
            // Success message or further action if needed
          } else {
            echo "Error deleting architect: " . $conn->error;
          }
        } else {
          echo "Error deleting projects: " . $conn->error;
        }
      }
      $conn->close();
      ?>
    </div>
  </div>
  <script>
    function togglePopup() {
      $(".popup-wrapper1").toggle();
    }

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