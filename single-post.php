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
          <li><a href="login.php">Login</a></li><!--Changed the href link to login.php and  content of list element to login  -->
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

      <section class="single-post-content">
        <div class="container">
          <div class="row">
            <div class="col-md-9 post-content" data-aos="fade-up">

              <!-- ======= Single Post Content ======= -->
              <?php
                  // Retrieve the event number from the GET request
                  $e_Number = $_GET['eventNumber'];

                  include 'serverlogin.php';

                  // Establish connection
                  $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
                  if (!$conn) {
                      die("Connection failed!" . mysqli_connect_error());
                  } 

                  // Query to retrieve events data
                  $data_Events = "SELECT * FROM Events";
                  $output = $conn->query($data_Events);
                  if ($output->num_rows > 0) {
                      // Loop through each event
                      while ($data = $output->fetch_assoc()) {
                          // Retrieve event details
                          $event_Id = $data['EventID'];
                          $group_ID = $data['GroupID'];
                          $event_Type_Id = $data['EventTypeID'];
                          $date_Of_Event = $data['EventDate'];
                          $date_time = date_create($date_Of_Event);
                          $date_format = date_format($date_time, 'D d M, Y');
                          $time_format = date_format($date_time, 'g:i A');
                          $event_Title = $data['EventTitle'];
                          $description_Of_Event = $data['EventDesc'];
                          $images = $data['EventImage'];

                          // Query to retrieve group details
                          $sql_Groups = "SELECT * FROM Groups";
                          $output_groups = $conn->query($sql_Groups);
                          $Group_Name = " ";
                          $Group_Image = " ";
                          $Contact_Name = " ";
                          $Contact_Email = " ";
                          if ($output_groups->num_rows > 0) {
                              while ($data_groups = $output_groups->fetch_assoc()) {
                                  $Group_ID = $data_groups['GroupID'];
                                  if ($group_ID === $Group_ID) {
                                      $Group_Name = $data_groups['GroupName'];
                                      $Contact_Name = $data_groups['contactName'];
                                      $Contact_Email = $data_groups['ContactEmail'];
                                      break;
                                  }
                              }
                          }

                          // Query to retrieve event type
                          $sql_eventType = "SELECT * FROM EventType";
                          $output_eventType = $conn->query($sql_eventType);
                          $Event_Type = " ";
                          if ($output_eventType->num_rows > 0) {
                              while ($data_eventType = $output_eventType->fetch_assoc()) {
                                  $Event_Type_ID = $data_eventType['EventTypeID'];
                                  if ($Event_Type_ID === $event_Type_Id) {
                                      $Event_Type = $data_eventType['EventType'];
                                      break;
                                  }
                              }
                          }

                          // Check if the current event matches the requested event number
                          if ($e_Number === $event_Id) {
                              // Extracting the first character of the description
                              $var1 = substr($description_Of_Event, 0, 1);
                              // Extracting the rest of the description
                              $var2 = substr($description_Of_Event, 1, strlen($description_Of_Event));

                              // Display event details
                              echo '<div class="single-post">';
                              echo '<div class="post-meta"><span class="date">' . $Event_Type . '</span> <span class="mx-1">&bullet;</span> <span>DATE: ' . $date_format . ' TIME: ' . $time_format . '</span></div>';
                              echo '<br>';
                              echo '<h1 class="mb-5">' . $event_Title . '</h1>';
                              echo '<h3>Organizers: ' . $Group_Name . '</h3>';
                              echo '<h5>(Contact ' . $Contact_Name . ' at ' . $Contact_Email . ' for more info)</h5><br>';
                              echo '<p><span class="firstcharacter">' . $var1 . '</span>' . $var2 . '</p>';
                              echo '<img src=' . $images . ' alt="" class="img-fluid">';
                              echo '</div>';
                              break;
                          }
                      }
                  }


              ?>

              
              
              <!-- ======= Comments ======= -->
              <div class="comments">
                <h5 class="comment-title py-4">2 Comments</h5>
                <div class="comment d-flex mb-4">
                  <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                      <img class="avatar-img" src="assets/img/person-5.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-2 ms-sm-3">
                    <div class="comment-meta d-flex align-items-baseline">
                      <h6 class="me-2">Jordan Singer</h6>
                      <span class="text-muted">2d</span>
                    </div>
                    <div class="comment-body">
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam eligendi repellendus excepturi quibusdam nobis esse accusantium.
                    </div>

                    <div class="comment-replies bg-light p-3 mt-3 rounded">
                      <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                      <div class="reply d-flex mb-4">
                        <div class="flex-shrink-0">
                          <div class="avatar avatar-sm rounded-circle">
                            <img class="avatar-img" src="assets/img/person-4.jpg" alt="" class="img-fluid">
                          </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-sm-3">
                          <div class="reply-meta d-flex align-items-baseline">
                            <h6 class="mb-0 me-2">Brandon Smith</h6>
                            <span class="text-muted">2d</span>
                          </div>
                          <div class="reply-body">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                          </div>
                        </div>
                      </div>
                      <div class="reply d-flex">
                        <div class="flex-shrink-0">
                          <div class="avatar avatar-sm rounded-circle">
                            <img class="avatar-img" src="assets/img/person-3.jpg" alt="" class="img-fluid">
                          </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-sm-3">
                          <div class="reply-meta d-flex align-items-baseline">
                            <h6 class="mb-0 me-2">James Parsons</h6>
                            <span class="text-muted">1d</span>
                          </div>
                          <div class="reply-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="comment d-flex">
                  <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                      <img class="avatar-img" src="assets/img/person-2.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="flex-shrink-1 ms-2 ms-sm-3">
                    <div class="comment-meta d-flex">
                      <h6 class="me-2">Santiago Roberts</h6>
                      <span class="text-muted">4d</span>
                    </div>
                    <div class="comment-body">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto laborum in corrupti dolorum, quas delectus nobis porro accusantium molestias sequi.
                    </div>
                  </div>
                </div>
              </div><!-- End Comments -->

              <!-- ======= Comments Form ======= -->
              <div class="row justify-content-center mt-5">

                <div class="col-lg-12">
                  <h5 class="comment-title">Leave a Comment</h5>
                  <div class="row">
                    <div class="col-lg-6 mb-3">
                      <label for="comment-name">Name</label>
                      <input type="text" class="form-control" id="comment-name" placeholder="Enter your name">
                    </div>
                    <div class="col-lg-6 mb-3">
                      <label for="comment-email">Email</label>
                      <input type="text" class="form-control" id="comment-email" placeholder="Enter your email">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="comment-message">Message</label>

                      <textarea class="form-control" id="comment-message" placeholder="Enter your name" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12">
                      <input type="submit" class="btn btn-primary" value="Post comment">
                    </div>
                  </div>
                </div>
              </div><!-- End Comments Form -->

            </div>
            <div class="col-md-3">
              <!-- ======= Sidebar ======= -->
              <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Upcoming</button>
                </li>
               
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest Added</button>
                </li>
              </ul>
              <!-- Chnaged Popular , Trending and Latest to Upcoming and Latest Added. -->

              <div class="tab-content" id="pills-tabContent">

                  <!-- Popular -->
                  <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                  <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                  <?php
                    $upcoming_event_query = "SELECT Events.EventID, Events.EventTypeID, Events.GroupID, Events.EventDate, Events.SubmitDate, Events.EventTitle, Events.EventImage, Events.EventDesc, EventType.EventType, Groups.GroupName, Groups.GroupImage, Groups.GroupType, Groups.GroupDesc, Groups.contactName, Groups.ContactEmail
                                              FROM Events
                                              INNER JOIN EventType ON Events.EventTypeID = EventType.EventTypeID
                                              INNER JOIN Groups ON Events.GroupID = Groups.GroupID
                                              WHERE EventDate >= CURDATE() ORDER BY EventDate ASC LIMIT 6";
                    $upcoming_event_query_result = mysqli_query($conn,$upcoming_event_query);

                    if(mysqli_num_rows($upcoming_event_query_result) > 0){
                      while($upcoming_event_query_output = mysqli_fetch_assoc($upcoming_event_query_result)){
                        $EventDate= $upcoming_event_query_output['EventDate'];
                        $date = date_create($EventDate);
                        $date_format = date_format($date, 'd-M-y');

                        echo '<div class="post-entry-1 border-bottom">';
                        echo  '<div class="post-meta"><span class="date">'.$upcoming_event_query_output['EventType'].'</span> <span class="mx-1">&bullet;</span> <span>'.$date_format.'</span></div>';
                        echo  '<h2 class="mb-2"><a href="single-post.php?eventNumber=' . $upcoming_event_query_output['EventID'] . '">'.$upcoming_event_query_output['EventTitle'].'</a></h2>';
                        echo  '<span class="author mb-3 d-block">'.$upcoming_event_query_output['GroupName'].'</span>';
                        echo '</div>';
                        
                      }
                    }
                    
                  ?>
                  
                </div> <!-- End Popular -->

                
                <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                <?php
                    // SQL query to retrieve event information
                    $latest_event_query = "SELECT Events.EventID, Events.EventTypeID, Events.GroupID, Events.EventDate, Events.SubmitDate, Events.EventTitle, Events.EventImage, Events.EventDesc, EventType.EventType, Groups.GroupName, Groups.GroupImage, Groups.GroupType, Groups.GroupDesc, Groups.contactName, Groups.ContactEmail
                    FROM Events
                    INNER JOIN EventType ON Events.EventTypeID = EventType.EventTypeID
                    INNER JOIN Groups ON Events.GroupID = Groups.GroupID
                    ORDER BY Events.SubmitDate DESC";

                    // Execute the query
                    $latest_event_query_result = mysqli_query($conn, $latest_event_query);

                    // Check if the query was executed successfully
                    if (!$latest_event_query_result) {
                    die("Query failed: " . mysqli_error($conn));
                    }

                    // Check if there are rows returned by the query
                    if (mysqli_num_rows($latest_event_query_result) > 0) {
                    // Loop through each row of the result set
                    while ($latest_event_query_output = mysqli_fetch_assoc($latest_event_query_result)) {
                    // Format the date
                    $EventSubmitDate = $latest_event_query_output['EventDate'];
                    $SubmitDate = date_create($EventSubmitDate);
                    $Submitdate_format = date_format($SubmitDate, 'd-M-y');

                    // Output event information
                    echo '<div class="post-entry-1 border-bottom">';
                    echo '<div class="post-meta"><span class="date">' . $latest_event_query_output['EventType'] . '</span> <span class="mx-1">&bullet;</span> <span>' . $Submitdate_format . '</span></div>';
                    echo '<h2 class="mb-2"><a href="single-post.php?eventNumber=' . $latest_event_query_output['EventID'] . '">' . $latest_event_query_output['EventTitle'] . '</a></h2>';
                    echo '<span class="author mb-3 d-block">' . $latest_event_query_output['GroupName'] . '</span>';
                    echo '</div>';
                    }
                    } else {
                    echo "No events found.";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                  ?>
                    
                  

                </div> <!-- End Latest -->

                </div>
              </div>


              <div class="aside-block">
              <h3 class="aside-title">Events</h3>
              <ul class="aside-links list-unstyled">
                <li><a href="events.php?Type=All"><i class="bi bi-chevron-right"></i> All Events</a></li><!-- Changed the content of list element to All Events-->
                <li><a href="events.php?Type=Music"><i class="bi bi-chevron-right"></i> Music</a></li><!-- Changed the content of list element to Music-->
                <li><a href="events.php?Type=Art%2bCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li><!-- Changed the content of list element to Art+Culture-->
                <li><a href="events.php?Type=Sport"><i class="bi bi-chevron-right"></i> Sport</a></li><!-- Changed the content of list element to Sport-->
                <li><a href="events.php?Type=Food"><i class="bi bi-chevron-right"></i> Food</a></li><!-- Changed the content of list element to Food-->
                <li><a href="events.php?Type=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li><!-- Changed the content of list element to Fund Raiser-->

              </ul>
            </div><!-- End Categories -->

            <div class="aside-block">
              <h3 class="aside-title">Tags</h3>
              <ul class="aside-tags list-unstyled">
                <li><a href="events.php?Type=All">All Events</a></li><!-- Changed the content of list element to All Events-->
                <li><a href="events.php?Type=Music">Music</a></li><!-- Changed the content of list element to Music-->
                <li><a href="events.php?Type=Art%2bCulture">Art+Culture</a></li><!-- Changed the content of list element to Art+Culture-->
                <li><a href="events.php?Type=Sport">Sport</a></li><!-- Changed the content of list element to Sport-->
                <li><a href="events.php?Type=Food">Food</a></li><!-- Changed the content of list element to Food-->
                <li><a href="events.php?Type=Fund Raiser">Fund Raiser</a></li><!-- Changed the content of list element to Fund Raiser-->


              </ul>
            </div><!-- End Tags -->

            </div>
          </div>
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
              <li><a href="events.php"><i class="bi bi-chevron-right"></i> Events</a></li><!--Changed the href link to event.php and  content of list element to Events -->
              <li><a href="groups.php"><i class="bi bi-chevron-right"></i> Community Groups</a></li><!--Changed the href link to groups.php and  content of list element to Community Groups -->
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> About</a></li><!--Changed the href link to obout.php and  content of list element to About -->
              <li><a href="post.php"><i class="bi bi-chevron-right"></i> Post Event</a></li><!-- Created new Element under the Navigation list called post and linked it to post.php -->
              <li><a href="login.php"><i class="bi bi-chevron-right"></i> Login</a></li><!--Changed the href link to login.php and  content of list element to login -->
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Events</h3><!-- Changed the content in h3 element to Events-->
            <ul class="footer-links list-unstyled">
              <li><a href="events.php?category=All"><i class="bi bi-chevron-right"></i> All Events</a></li><!-- Changed the content of list element to All Events and used the query string to add functionality-->
              <li><a href="events.php?category=Music"><i class="bi bi-chevron-right"></i> Music</a></li><!-- Changed the content of list element to Music and used the query string to add functionality-->
              <li><a href="events.php?category=Art%2bCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li><!-- Changed the content of list element to Art+Culture and used the query string to add functionality-->
              <li><a href="events.php?category=Sport"><i class="bi bi-chevron-right"></i> Sport</a></li><!-- Changed the content of list element to Sport and used the query string to add functionality-->
              <li><a href="events.php?category=Food"><i class="bi bi-chevron-right"></i> Food</a></li><!-- Changed the content of list element to Food and used the query string to add functionality-->
              <li><a href="events.php?category=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li><!-- Changed the content of list element to Fund Raiser and used the query string to add functionality-->

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
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

  </body>

</html>