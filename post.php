<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['GroupID'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the rest of the script
}

// Include the database connection file
include 'serverlogin.php';

// Establish connection
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the group name based on GroupID stored in the session
$groupID = $_SESSION['GroupID'];
$group_Query = "SELECT GroupName FROM Groups WHERE GroupID = $groupID";
$group_Result = mysqli_query($conn, $group_Query);
$groupName = " ";
if (isset($group_Result) && mysqli_num_rows($group_Result) > 0) {
    $groupData = mysqli_fetch_assoc($group_Result);
    $groupName = $groupData['GroupName'];
} 

// Close the database connection
mysqli_close($conn);
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
            <h1 class="page-title">Post New Event</h1>
            <!--Change the content of h1 to Login from Constat us-->
            <?php
            echo '<br><br><h3>'.$groupName.'</h3>' ;
            ?>
          </div>
        </div>
        <!-- Removed the top row-->

          <!-- //Changed the format of the form similar in the login.php and modified the id and the name  -->
        <div class="form mt-5">
          <form action="post.php" method="post" role="form" class="php-email-form">
               
              
                <input type="text" class="form-control" name="eventName" id="eventName" placeholder="Your Event Title" required>
                
                <input type="text" class="form-control" name="dateOfEvent" id="dateOfEvent" placeholder="Your Event Date [Format: year-month-date]" required>
              
                <input type="text" name="time" id="time" class="form-control" placeholder="Your Event time [Format: XX:YY AM/PM]" required>
              
                <input type="text" class="form-control" name="eventType" id="eventType" placeholder="Your Event Type" required>
              
                <input type="text" class="form-control" name="images" id="images" placeholder="Image Name" required>
              
                <textarea class="form-control" name="descriptionOfEvent" rows="5" placeholder="The Event Description" required></textarea>
              
                <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit">Submit</button></div>
          </form>
          <?php
              // Check if the request method is POST
              if ($_SERVER["REQUEST_METHOD"] === "POST") {
                  
                  include 'serverlogin.php';
                  
                  // Establish connection
                  $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
                  
                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . mysqli_connect_error());
                  }
                  $groupID = $_SESSION['GroupID'];
                  $group_Query = "SELECT GroupName FROM Groups WHERE GroupID = $groupID";
                  $group_Result = mysqli_query($conn, $group_Query);
                  $groupName = " ";
                  if (isset($group_Result) && mysqli_num_rows($group_Result) > 0) {
                      $groupData = mysqli_fetch_assoc($group_Result);
                      $groupName = $groupData['GroupName'];
} 

                  $eventName = $_POST['eventName'];
                  $dateOfEvent = $_POST['dateOfEvent'];
                  $time = $_POST['time'];
                  $eventType = $_POST['eventType'];
                  $images = $_POST['images'];
                  $descriptionOfEvent = $_POST['descriptionOfEvent'];

                  // Convert date and time to DateTime object and format for database insertion
                  $Final_Event_Date_Time = strtotime("$dateOfEvent $time");
                  $event_Date = date('Y-m-d H:i:s', $Final_Event_Date_Time);
                  $Submit_Date = date('Y-m-d H:i:s');

                  // Query to retrieve EventTypeID based on the event type
                  $EventType_Query = "SELECT EventTypeID FROM EventType WHERE EventType = '$eventType'";
                  $EventType_Result = mysqli_query($conn, $EventType_Query);
                  $EventType_Output = mysqli_fetch_assoc($EventType_Result);
                  $EventTypeId = $EventType_Output["EventTypeID"];

                  // Query to retrieve GroupID based on the group name
                  $Group_Query = "SELECT GroupID FROM Groups WHERE GroupName = '$groupName'";
                  $Group_Result = mysqli_query($conn, $Group_Query);
                  $Group_Output = mysqli_fetch_assoc($Group_Result);
                  $Group_Id = $Group_Output["GroupID"];

                  // Query to retrieve the maximum EventID
                  $Max_EventID_Query = "SELECT MAX(EventID) AS Max_EventID FROM Events";
                  $Max_EventID_Result = mysqli_query($conn, $Max_EventID_Query);
                  $Max_EventID_Output = mysqli_fetch_assoc($Max_EventID_Result);
                  $Current_Max_EventID = $Max_EventID_Output['Max_EventID'];
                  $Latest_EventID = $Current_Max_EventID + 1;

                  // Construct final image path
                  $Final_Image = "files/images/events/" . $images;

                  // Prepare and execute the INSERT statement
                  $Insert_Statement = $conn->prepare("INSERT INTO Events (EventID, EventTypeID, GroupID, EventDate, SubmitDate, EventTitle, EventImage, EventDesc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                  $Insert_Statement->bind_param("iiisssss", $Latest_EventID, $EventTypeId, $Group_Id, $event_Date, $Submit_Date, $eventName, $Final_Image, $descriptionOfEvent);
                  $Insert_Statement->execute();
                  $Insert_Statement->close();
                  
                  // Close connection
                  $conn->close();
              } else {
                  // If the request method is not POST, do nothing
              }
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