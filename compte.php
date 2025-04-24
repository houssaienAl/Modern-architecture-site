<html>
<?php
session_start();
require 'db.php';


$usera = $_SESSION['username'];
$sql = "SELECT  *
        FROM
        users
        WHERE 
        users.username='$usera';";
$result = $conn->query($sql);
if ($row = $result->fetch_assoc()) {
  $mail = ($row['mail']);
  $tel = ($row['telephone']);
  $image = ($row['image']);
  $company = ($row['company']);
  $address = ($row['address']);
}

if (isset($_POST['bsubmit'])) {
  if ($_FILES['userfile']['error'] == 0) { // pas d'erreur
    foreach ($_FILES['userfile'] as $prop => $val) {
      $uploadDirectory = "images/Profile_picture/"; // You should replace this with the actual directory path on your server
      $filePath = $uploadDirectory . basename($_FILES['userfile']['name']);
      echo $filePath;
      $sql = "UPDATE users
      SET users.image= ('$filePath')
      WHERE users.username= '$usera' ;";
      $result = $conn->query($sql);
    }
    // vérification que fichier sur le serveur
    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
      echo 'Le fichier a bien été uploadé sur le serveur.';
    }
    $target_dir = "images/Profile_picture/"; // Specify the directory where files should be saved
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


} ?>

<head>
<title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="Profile_person.css">
  <link rel="stylesheet" type="text/css" href="css/compte.css" />
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
  </style>

</head>
<?php
      if (isset($_POST["logout"])) {
        // Destroy the session to effectively log out the user
        $_SESSION = array();       // Clear the session array
        session_destroy();         // Destroy the session data on the server
        header("Location: home.php");
      }
      ?>

<body>
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
            <a class="nav-link  mx-4 display-nav text-white" href="Profiles.php">PROFILES</a>
            <a class="nav-link text-white mx-4 display-nav" href="portfolio.php">PORTFOLIO</a>
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



  <section class="container pt-5">
    <hr style="height:80px;color:transparent;">
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
      echo '
    <div  class="d-flex flex-row align-items-start gab-5">
    <div class="px-5">
    <img src="' . $image . '" alt="Avatar" class="img-fluid my-5 " style="width: 300px;height: 300px;" />
    <hr class="mt-0 mb-4">
    <div class="row pt-1">';
    } ?>
    <form enctype="multipart/form-data" action="#" method="POST">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
      Sélectionner un fichier : <input name="userfile" type="file" /><br /><br />
      <input type="submit" name="bsubmit" class="btn btn-dark" value="Send file" />
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
      echo '
          </div>
          </div>
          <div>
          <div class="row mb-4">
          <div data-mdb-input-init class="form-outline mb-4">
          <input type="text" id="form6Example3" class="form-control" value="' . $usera . '" class="field left" readonly/>
          <label class="form-label" for="form6Example3">Username</label>
        </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form6Example3" class="form-control" value="' . $company . '" class="field left" readonly/>
            <label class="form-label" for="form6Example3">Company name</label>
          </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form6Example4" class="form-control" value="' . $address . '" class="field left" readonly/>
            <label class="form-label" for="form6Example4">Address</label>
          </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form6Example5" class="form-control"value="' . $mail . '" class="field left" readonly />
            <label class="form-label" for="form6Example5">Email</label>
          </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="number" id="form6Example6" class="form-control"value="' . $tel . '" class="field left" readonly />
            <label class="form-label" for="form6Example6">Phone</label>
          </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <textarea class="form-control" id="form6Example7" rows="4"></textarea>
            <label class="form-label" for="form6Example7">Additional information</label>
          </div>
          <button class="btn btn-danger" name="logout">LOG OUT</button>
          </form>
          </div>
  ';
    } ?>
    <!-- Submit button -->
  </sections>


      

    </div>


</body>

</html>
