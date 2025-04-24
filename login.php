<?php
session_start();
require "db.php";
$error = false;
if (isset($_POST["submit"])) {
  if (!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['mail'])) {

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];

    // Check if username or email already exists
    $query = "SELECT * FROM users WHERE username='" . $user . "' OR mail='" . $mail . "'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
      // Username and email don't exist, so insert new user
      $sql = "INSERT INTO users(username,password,mail,telephone) VALUES ('$user', '$pass','$mail','$tel')";
      if ($conn->query($sql) === TRUE) {
        $error = "Account Successfully Created";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      $existingData = $result->fetch_assoc();
      if ($existingData['username'] == $user) {
        $error = "That username already exists! Please try again with another.";
      }
      if ($existingData['mail'] == $mail) {
        $error = "That email already exists! Please try again with another.";
      }
      if ($existingData['tel'] == $tel) {
        $error = "That email already exists! Please try again with another.";
      }
    }

    $conn->close(); // Close the connection
  } else {
    $error = "Username or Password is empty!";
  }
}
if (isset($_POST["submit2"])) {
  if (!empty($_POST['mail']) && !empty($_POST['pass'])) {

    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $password = $_POST['pass'];

    $query = "SELECT * FROM users WHERE mail='$mail'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && $password == $user['password']) {
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $user['username'];
      header("Location: home.php"); // Redirect to the index page
    } else {
      $error = "Invalid username or password!";
    }
  } else {
    $error = "Username or Password is empty!";
  }
}


?>
<html lang="en" class="scrollable-content">

<head>
  <title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
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

<body >
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <div class=" ms-xl-4 py-2">
            <a class="navbar-brand fs-2 text-black mx-1" style="font-weight:800;" href="Home.php">3Helazel</a>

          </div>
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
            <form style="width: 23rem;" action="" method="POST">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
              <label class="form-label" for="form2Example18">Email address</label>
              <input type="email" name="mail" id="form2Example28" class="form-control form-control-lg"><br />
              <label class="form-label" for="form2Example28">Password</label>
              <input type="password" name="pass" id="form2Example28" class="form-control form-control-lg"><br />
              <div class="pt-1 mb-4">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit"
                  value="Login" name="submit2" id="MyButton">Login</button>
              </div>
              <?php
              if (isset($error)) {
                echo "<p style='color: red;'>$error</p>"; // Display error message
              }
              ?>
              <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
              <p>Don't have an account? <a onclick="togglePopup()" class="link-info">Register here</a></p>
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="images/pexels-emrecan-2079622.jpg" alt="Login image" class="w-100 vh-100"
            style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
    <div class="popup-wrapper1 ">
      <div>
        <section class="vh-100" style="background-color:transparent;">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                  <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                      <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                        <div onclick="togglePopup()" class="btn-close btn-close-black close">
                        </div>
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                        <form class="mx-1 mx-md-4 " action="" method="POST">
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                              <input type="text" id="form3Example1c" class="form-control" name="user">
                              <label class="form-label" for="form3Example1c">Your Name</label>
                            </div>
                          </div>
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                              <input type="email" id="form3Example3c" class="form-control" name="mail">
                              <label class="form-label" for="form3Example3c">Your Email</label>
                            </div>
                          </div>

                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                              <input type="password" id="form3Example4c" class="form-control" name="pass">
                              <label class="form-label" for="form3Example4c">Password</label>
                            </div>
                          </div>

                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                              <input id="form3Example4cd" class="form-control" name="tel">
                              <label class="form-label" for="form3Example4cd">Telephone</label>
                            </div>
                          </div>

                          <div class="form-check d-flex justify-content-center mb-5">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                            <label class="form-check-label" for="form2Example3">
                              I agree all statements in <a href="#!">Terms of service</a>
                            </label>
                          </div>
                          <?php
                          if (isset($error)) {
                            echo "<p style='color: red;'>$error</p>"; // Display error message
                          }
                          ?>
                          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init
                              class="btn btn-primary btn-lg" id="mybutton">Register</button>
                          </div>
                        </form>
                      </div>
                      <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                        <img src="images/pexels-pixasquare-1115804.jpg" class="img-fluid" alt="Sample image">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
  <script>
    function togglePopup() {
      $(".popup-wrapper1").toggle();
    }

  </script>

</body>

</html>