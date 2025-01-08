<?php
session_start();

// Include the file containing database credentials
require_once 'serverlogin.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Establish connection
    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $groupName = $_POST['groupName'];
    $groupType = $_POST['eventType'];
    $groupDescription = $_POST['groupDesc'];
    $group_Image = $_POST['groupImage'];
    $GroupImagefinalLocation = "files/images/Groups/" . $group_Image;
    $contactName = $_POST['contactName'];
    $contactEmail = $_POST['contactEmail'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $errorMsg = ""; 
  //Chevcking the request method
    if(strlen($password) < 7){
        $errorMsg .= "Error! Password needs at least 7 characters.<br> ";
    }
    //Condition to check the presence of Capital letter
    if(!preg_match('/[A-Z]/', $password)){
        $errorMsg .= "Error! Password needseed at least 1 Capital Letter.<br> ";
    }
    //Condition to check the presence of number in the password
    if(!preg_match('/[0-9]/', $password)){
        $errorMsg .= "Error! Password needseed at least 1 Number.<br> ";
    }
    //Condition to check the presence of special character 
    if (!preg_match('/[a-zA-Z0-9]/', $password)) {
        $errorMsg .= "Error! Password needs atleast one special character.<br>";
    }
    //default output if non of the condition matches and password satisfy  all the condition.
    if (empty($errorMsg)) {
        $errorMsg = "Password Successful!";
    }
    
    // Check if the username already exists
    $loginCheckQuery = $conn->prepare("SELECT Username FROM Login WHERE Username = ?");
    $loginCheckQuery->bind_param("s", $userName);
    $loginCheckQuery->execute();
    $result = $loginCheckQuery->get_result();
    if ($result->num_rows > 0) {
        echo '<div class="text-center"><p>Username already exists, please try again</p></div>';
    } 
    else {
      if(empty($password))
      {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Prepare and bind the INSERT statement for Groups table
        $insertGroup = $conn->prepare("INSERT INTO Groups (GroupID, GroupName, GroupImage, GroupType, GroupDesc, contactName, ContactEmail) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertGroup->bind_param("issssss", $newGroupID, $groupName, $GroupImagefinalLocation, $groupType, $groupDescription, $contactName, $contactEmail);

        // Prepare and bind the INSERT statement for Login table
        $insertLogin = $conn->prepare("INSERT INTO Login (AccountID, GroupID, Username, Password) VALUES (?, ?, ?, ?)");
        $insertLogin->bind_param("iiss", $newAccountID, $newGroupID, $userName, $hashedPassword);

        // Get the max GroupID
        $lastGroupIdQuery = $conn->prepare("SELECT MAX(GroupID) AS maxGroupID FROM Groups");
        $lastGroupIdQuery->execute();
        $lastGroupIdResult = $lastGroupIdQuery->get_result();
        $lastGroupIdRow = $lastGroupIdResult->fetch_assoc();
        $newGroupID = $lastGroupIdRow['maxGroupID'] + 1;

        // Insert into Groups table
        $insertGroup->execute();

        // Get the max AccountID
        $lastAccountIdQuery = $conn->prepare("SELECT MAX(AccountID) AS maxAccountID FROM Login");
        $lastAccountIdQuery->execute();
        $lastAccountIdResult = $lastAccountIdQuery->get_result();
        $lastAccountIdRow = $lastAccountIdResult->fetch_assoc();
        $newAccountID = $lastAccountIdRow['maxAccountID'] + 1;

        // Insert into Login table
        $insertLogin->execute();

        $_SESSION['login'] = TRUE;
        $_SESSION['GroupID'] = $newGroupID;
        $_SESSION['AccountID'] = $newAccountID;
        header("Location: post.php");
        exit();
      }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>What's Happening</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>What's Happening</h1><!--Changed the heading from ZenBlog to What's happening -->
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href="events.php?Type=All"><span>Events</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a><!--Changed the href link to events.php -->
            <ul>
              <li><a href="events.php?Type=All">All Events</a></li><!--Changed the content of list element to All Events-->
              <li><a href="events.php?Type=Music">Music</a></li>
              <li ><a href="events.php?Type=Art%2bCulture"><span>Art+Culture</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a><!--Changed the content of list element to Art+Culture-->
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li> 
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="events.php?Type=Sports">Sport</a></li><!--Changed the content of list element to Sport-->
              <li><a href="events.php?Type=Food">Food</a></li><!--Changed the content of list element to Food-->
              <li><a href="events.php?Type=Fund Raiser">Fund Raiser</a></li><!--Changed the content of list element to Fund Raiser-->
            </ul>
          </li>
          <li><a href="groups.php">Community Groups</a></li><!--Changed the href link to groups.php and  content of list element to Community Groups -->
          <li><a href="about.php">About</a></li><!--Changed the href link to about.php  -->
          <li><a href="post.php">Post Event</a></li><!--Created new element in the navigation bar with the href link to post.php  -->
          <li class="dropdown"><a href="login.php"><span>Login</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="login.php?logout=true">Logout</a></li>

              </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->


      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">Create Account</h1>
            <!--Change the content of h1 to Login from Constat us-->
          </div>
        </div>
        <!-- Removed the top row-->

          <!-- //Changed the format of the form similar in the login.php and modified the id and the name  -->
        <div class="form mt-5">
        <form action="createAccount.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group">
                <div><strong><p>Tell us about your group:</p></strong></div>
                <input type="text" name="groupName" class="form-control" id="groupName" placeholder="Your Community Group" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="eventType" id="eventType" placeholder="What type of group are you?" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="contactName" id="contactName" placeholder="Provide a Contact Name for your group" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="contactEmail" id="contactEmail" placeholder="Provide a Contact Email for your group" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="groupImage" id="groupImage" placeholder="Group Image Name" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="groupDesc" id ="groupDesc" rows="2" placeholder="Tell us about your group" required></textarea>
            </div>
            <br>
            <div><p><strong>Create an Account:</p></strong>
            <div class="form-group">
              <input type="text" class="form-control" name="userName" id="userName" placeholder="Create a Username" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password" placeholder="Create a Password" required>
            </div>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit" style="background-color: green; color: white">Submit</button></div>
            <!-- Changed the button from send message to login-->
            
          </form>
          <?php
              
              if(isset($errorMsg)) {
                echo '<br>';
                echo '<div class="text-center"><p>'.$errorMsg.'</p></div>';
              }
              // mysqli_close($conn);
            ?>
          
   


      
        </div><!-- End Contact Form -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

  <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About What's Happening</h3><!-- Changed the content in h3 element to About What's Happening-->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.php" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3><!-- Changed the content in h3 element to About What's Happening-->
            <ul class="footer-links list-unstyled">
              <li><a href="index.php"><i class="bi bi-chevron-right"></i> Home</a></li><!--Changed the href link to index.php and  content of list element to Home -->
              <li><a href="events.php?Type=All"><i class="bi bi-chevron-right"></i> Events</a></li><!--Changed the href link to event.php and  content of list element to Events -->
              <li><a href="groups.php"><i class="bi bi-chevron-right"></i> Community Groups</a></li><!--Changed the href link to groups.php and  content of list element to Community Groups -->
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> About</a></li><!--Changed the href link to obout.php and  content of list element to About -->
              <li><a href="post.php"><i class="bi bi-chevron-right"></i> Post Event</a></li><!-- Created new Element under the Navigation list called post and linked it to post.php -->
              <li><a href="login.php"><i class="bi bi-chevron-right"></i> Login</a></li><!--Changed the href link to login.php and  content of list element to login -->
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Events</h3><!-- Changed the content in h3 element to Events-->
            <ul class="footer-links list-unstyled">
              <li><a href="events.php?Type=All"><i class="bi bi-chevron-right"></i> All Events</a></li><!-- Changed the content of list element to All Events and used the query string to add functionality-->
              <li><a href="events.php?Type=Music"><i class="bi bi-chevron-right"></i> Music</a></li><!-- Changed the content of list element to Music and used the query string to add functionality-->
              <li><a href="events.php?Type=Art%2bCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li><!-- Changed the content of list element to Art+Culture and used the query string to add functionality-->
              <li><a href="events.php?Type=Sports"><i class="bi bi-chevron-right"></i> Sport</a></li><!-- Changed the content of list element to Sport and used the query string to add functionality-->
              <li><a href="events.php?Type=Food"><i class="bi bi-chevron-right"></i> Food</a></li><!-- Changed the content of list element to Food and used the query string to add functionality-->
              <li><a href="events.php?Type=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li><!-- Changed the content of list element to Fund Raiser and used the query string to add functionality-->

            </ul>
          </div>
        </div>
      </div>
    </div>




    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>