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
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/ [1].
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>What's Happening</h1>
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
    <!--Removed content from here only slider remains-->
    <!--Also removed one slider-->
    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="single-post.php" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-1.jpg');">
                    <div class="img-bg-inner">
                      <h2>What's Happening in your Community</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.</p>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  
                <?php
                        include 'serverlogin.php';
            
                        // Establish connection
                        $conn = mysqli_connect ($db_hostname, $db_username, $db_password, $db_database);
                        if (!$conn) {
                          die("Connection failed!".mysqli_connect_error());
                        } 
            
                        // Query to select latest event based on SubmitDate
                        $events = "SELECT * FROM events ORDER BY SubmitDate DESC LIMIT 1"; // Unique date
                        $result = mysqli_query($conn, $events);
            
                        // Check if the query ran successfully
                        if (!$result) {
                            die("Query failed!".mysqli_error($conn));
                        }
                        $eventTitle = '';
                        $eventDesc = '';
                        $event_ID = " ";

                        // Loop through each row in the event table
                        while($row = $result->fetch_assoc())
                        {
                          $eventTitle = $row["EventTitle"];
                          $eventDesc = $row["EventDesc"];
                          $event_ID = $row["EventID"];
                          break;
                        }
                        
                        // Display the latest event information
                        echo '<a href="single-post.php?eventNumber='.$event_ID.'"class="img-bg d-flex align-items-end" style="background-image: url(assets/img/post-slide-2.jpg)">';
                        echo  '<div class="img-bg-inner">';
                        echo '<h2>Latest Added Event</h2>';
                        echo '<p><b>'.$eventTitle.':</b>'. $eventDesc.'</p>';
                       
                        
                        // Closing the connection
                        $conn->close();
                      ?>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                      <?php
                       include 'serverlogin.php';
            
                        // Establish connection
                        $conn = mysqli_connect ($db_hostname, $db_username, $db_password, $db_database);
                        if (!$conn) {
                          die("Connection failed!".mysqli_connect_error());
                        } 
            
                        // Query to select the event happening soon based on EventDate
                        $events = "SELECT * FROM events WHERE EventDate >= CURDATE() ORDER BY EventDate ASC LIMIT 1"; // Unique date
                        $result = mysqli_query($conn, $events);
            
                        // Check if the query ran successfully
                        if (!$result) {
                            die("Query failed!".mysqli_error($conn));
                        }
                        $eventTitle = " ";
                        $eventDesc = " ";
                        $event_ID = " ";

                        // Loop through each row in the event table
                        while($row = $result->fetch_assoc())
                        {
                          $eventTitle = $row["EventTitle"];
                          $eventDesc = $row["EventDesc"];
                          $event_ID = $row["EventID"];
                          break;
                        }

                        // Display the information of the event happening soon
                        echo '<a href="single-post.php?eventNumber='.$event_ID.'"class="img-bg d-flex align-items-end" style="background-image: url(assets/img/post-slide-3.jpg)">';
                        echo  '<div class="img-bg-inner">';
                        echo '<h2>Happening soon</h2>';
                        echo '<p><b>'.$eventTitle.':</b>'. $eventDesc.'</p>';
                        
                        // Closing the connection
                        $conn->close();
                      ?>

                    </div>
                  </a>
                </div>

              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
  
        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About What's Happening</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.php" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3>
            <ul class="footer-links list-unstyled">
              <!--Changed the links-->
              <li><a href="index.php"><i class="bi bi-chevron-right"></i> Home</a></li>
              <li><a href="events.php?Type=All"><i class="bi bi-chevron-right"></i> Events</a></li>
              <li><a href="groups.php"><i class="bi bi-chevron-right"></i> Community Groups</a></li>
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> About</a></li>
              <li><a href="post.php"><i class="bi bi-chevron-right"></i> Post Event</a></li>
              <li><a href="login.php"><i class="bi bi-chevron-right"></i> Login</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Events</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="events.php?Type=All"><i class="bi bi-chevron-right"></i> All Events</a></li>
              <li><a href="events.php?Type=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
              <li><a href="events.php?Type=Art%2BCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
              <li><a href="events.php?Type=Sports"><i class="bi bi-chevron-right"></i> Sports</a></li>
              <li><a href="events.php?Type=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
              <li><a href="events.php?Type=Fund%20Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
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
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ [1].-->
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
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<!--
References:

[1] "ZenBlog - Bootstrap Blog Template", <i>BOOTSTRAPMADE</i> [Online].
    Available: https://bootstrapmade.com/zenblog-bootstrap-blog-template/ [Accessed: Feb. 03, 2024]
-->