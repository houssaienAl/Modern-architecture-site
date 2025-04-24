<html>

<?php
session_start();
require 'db.php';
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query_string = parse_url($url, PHP_URL_QUERY);
parse_str($query_string, $params);
if (isset($params['architect_id'])) {
  $architect_id = $params['architect_id'];
  $encoded_architect_id = urlencode($architect_id);
} else {
  echo "Architect ID not found in the URL.";
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  $user = $_SESSION['username'];
}
 else {
  echo "Please log in first to see this page.";

}

$date = date("Y-m-d H:i:s");
if (isset($_POST["submit"])) {
  if (!empty($_POST['comment'])) {
    $comment = $_POST['comment'];

    $sql = "INSERT INTO commentsection(comments,username, ArchitectID, time_added) VALUES ('$comment','$user', '$architect_id','$date');";
    if ($conn->query($sql) === TRUE) {

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

}
?>

<head>
<title>3helazel</title>
  <link rel="shortcut icon" href="images/logo.jpg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/Profile_person.css">
  <script src="https://kit.fontawesome.com/159d355e6f.js" crossorigin="anonymous"></script>

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

<body >
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
            <a class="nav-link  mx-4 display-nav " style="color:#ffc5aa" href="Profiles.php">PROFILES</a>
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



</body>



<?php
// Get the current URL from the address bar
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to get the query string
$query_string = parse_url($url, PHP_URL_QUERY);

// Parse the query string into variables
parse_str($query_string, $params);

// Check if architect_id is set in the URL
if (isset($params['architect_id'])) {
  $architect_id = $params['architect_id'];

  // URL-encode the architect_id value if needed for further usage in URLs
  $encoded_architect_id = urlencode($architect_id);

  // Output the original and encoded architect_idf
} else {
  echo "Architect ID not found in the URL.";
}
// Set up database connection

// SQL to fetch all profiles
$sql = "SELECT 
Architects.Name as ArchitectName,
Architects.ProfileImage as ArchitectImage,
Architects.ArchitectId as ArchitectID,
Architects.WorkedWith,
Architects.ProjectCategory as ProjectCategory,
projects.ProjectImage

FROM
 architects,projects
Where 
architects.ArchitectID = $architect_id;";
$result = $conn->query($sql);
// Check if we have results
if ($result) {
  // Output data of each row
  if ($row = $result->fetch_assoc()) {
    if (!isset($architect_id)) {
      echo "Project ID not found.";
      // You might want to redirect the user to an error page here
    } else {
      if (isset($_POST["rate"])) {  
        $rating = $_POST["rate"];

        // Update the rating in the database
        $sql = "UPDATE architects SET reviews=$rating WHERE ArchitectId='$architect_id';";
        if ($conn->query($sql) === TRUE) {
          $message = "Your rating is sent!";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }}
      }
      $architectproj = $row["ProjectCategory"];
      echo ' <div class=" d-flex  mt-5 ps-5 flex-row">';
      echo '<p class=" mt-5 ps-5 "style="font-weight:800;">OUR PROFILES/ </p> ';
      echo '<p class=" mt-5 ps-2"> ' . $row["ArchitectName"] . '</p>';
      echo '</div>';
      echo '  <div class=" d-flex justify-content-center ">';
      echo '<div class="d-flex flex-column justify-content-center gap-5 " >';
      echo '<div class="d-flex flex-row justify-content-center gap-5">';
      echo '<img src="' . $row["ArchitectImage"] . '"  class="img-dff3">';

      echo '<div class="d-flex flex-column ">';
      echo '<div class="d-flex flex-row pt-3">';
      echo '</div>';
      echo '<div class="d-flex flex-column py-3">';
      echo '<label class="text-name"> ' . $row["ArchitectName"] . '</label>';
      echo '<label class="text-name2">' . $row["ProjectCategory"] . '</label>';
      echo '</div>';
      echo '<div class="d-flex flex-row pe-2 pb-5">';
      echo '<button type="submit" id="follow" class="btn btn-primary" style="background-color: rgb(224, 107, 11);">follow</button>';
      echo '<button type="submit" id="message" class="ms-2 btn btn-outline-secondary">send message</button>';
      echo '</div>';
      echo '<label>';
      echo ' <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' . ?architect_id= ' . $architect_id . '; ">
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
  </form>';
      echo '</label>';
      echo '</div>';
      echo '</div>';
    


  }
}




?>
<div class=" m-5 d-flex justify-content-center ">

  <div class="d-flex flex-column justify-content-center gap-5 ">
    <p class=" mt-5 ps-5 h1 " style="font-weight:800;">Projects: </p>
    <div class="d-flex flex-wrap gap-5 container justify-content-center">
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
            architectID = '$architect_id'
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
  </div>
</div>
<section style="background-color: white;">
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="card text-dark">
          <div class="card-body p-4">
            <h4 class="mb-0">Recent comments</h4>
            <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>
            <div class="d-flex flex-column">
              <?php
              if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<p class="fw-bold">Add a comment:</p>';
                echo '<form action="" method="POST">';
                echo '<textarea name="comment" rows="10" cols="50" placeholder="Enter your comment here..." id="myTextarea"></textarea>';
                echo '<button type="submit" name="submit" id="checkButton">Submit</button>';
                echo '</form>';
              } ?>

            </div>
            <hr class='my-0' />

            <?php
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $query_string = parse_url($url, PHP_URL_QUERY);
            parse_str($query_string, $params);
            if (isset($params['architect_id'])) {
              $architect_id = $params['architect_id'];
              $encoded_architect_id = urlencode($architect_id);

            } else {
              echo "Architect ID not found in the URL.";
            }
            // fetch comments section by architect id
            $sql = "SELECT 
            commentsection.username as userna,
            commentsection.Comments,
            commentsection.architectid as archi_id,
            commentsection.time_added,
            commentsection.id as commentid,
            users.image as image
        FROM commentsection
        JOIN users ON commentsection.username = users.username  
        ORDER BY commentsection.time_added DESC;";

            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $row = array_map('htmlspecialchars', $row);
                if (htmlspecialchars($row['archi_id']) == $encoded_architect_id) {
                  echo '<div class="d-flex flex-start py-3">';
                  echo ' <img class="rounded-circle shadow-1-strong me-3"
              src="' . $row['image'] . '" alt="avatar" width="60"
              height="60" />';
                  echo '<div>';
                  echo "<h6 class='fw-bold mb-1'>" . htmlspecialchars($row['userna']) . "</h6>";
                  echo '<div class="d-flex align-items-center mb-3">';
                  echo '<p class="mb-0">';
                  echo htmlspecialchars($row['time_added']);
                  echo '</p>';
                  echo '<a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
              <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
              <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>';
                  echo '</div>';
                  echo "<p class='mb-0'>";
                  echo htmlspecialchars($row['Comments']);
                  echo "</p>";
                  echo "</div>";
                  if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) && ($_SESSION['username'] == "admin")) {
                    echo '<form method="post">';
                    echo '<input type="hidden" name="commentid" value="' . $row['commentid'] . '">';
                    echo '<button type="submit" name="deletecomment" class="btn btn-danger">Delete</button>';
                    echo '</form>';
                  }
                  echo '</div><hr class="my-0" />';
                }
              }
            }

            if (isset($_POST["deletecomment"])) {
              $delcom = $_POST["commentid"];
              $sql = "DELETE FROM commentsection WHERE commentsection.id=$delcom ;";
              if ($conn->query($sql) === TRUE) {

              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }

            }
            ?>


          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function () {
        $("#checkButton").click(function () {
          var textareaValue = $("#myTextarea").val().trim();
          if (textareaValue == "") {
            alert("Textarea is empty!");
          }
        });
      });
    </script>
</section>

<footer class="text-white text-center text-lg-start bg-dark t-5" style="width:5500px">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row mt-4">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">About company</h5>

        <p>
          At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
          voluptatum deleniti atque corrupti.
        </p>

        <p>
          Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
          molestias.
        </p>

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