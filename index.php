
<?php

include("includes/db.php");

$to_err = $from_err = $date_err =  $time_err = "";
$location_regex = $date_regex = $time_regex = "";
$to = $from = $date = $time = "";
$location_regex = "/^[A-Za-z]+$/";
$date_regex = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$time_regex = "/^([01][0-9]|2[0-3]):([0-5][0-9])$/";
$confirmation_error="";
if (isset($_POST['find'])) {


  if (!preg_match($location_regex, (trim($_POST['to'])))) {
    $to_err = "Enter valid city name";
  } else {
    $to = trim($_POST['to']);
  }
  if (!preg_match($location_regex, (trim($_POST['from'])))) {
    $from_err = "Enter valid city name";
  } else {
    $from = trim($_POST['from']);
  }

  if (!preg_match($date_regex, (trim($_POST['date'])))) {
    $date_err = "Enter valid date";
  } else {
    $date = trim($_POST['date']);
  }

  if (!preg_match($time_regex, (trim($_POST['time'])))) {
    $time_err = "Enter valid time";
  } else {
    $time = trim($_POST['time']);
  }
  if (empty($to_err) && empty($from_err) && empty($date_err) && empty($time_err) ) {
    $get_email = "select * from users where user_email='$u_email'";

    $run_email = mysqli_query($con, $get_email);

    $check_email = mysqli_num_rows($run_email);
  }

 

  




  
}
?>
<?php
include("includes/header.php");
?>

  <link href="assets/css/formstyle.css" rel="stylesheet">



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 
  <!-- Include Moment.js CDN -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
 
  <!-- Include Bootstrap DateTimePicker CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


  <!-- Include Date Range Picker -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <?php
  if($to_err!=""){
    ?><style>.to-error{display: block}</style><?php
  }
  if($from_err!=""){
    ?><style>.from-error{display: block}</style><?php
  }
  if($date_err!=""){
    ?><style>.date-error{display: block}</style><?php
  }
  if($time_err!=""){
    ?><style>.time-error{display: block}</style><?php
  }
  
?>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.php">SUIP<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <?php
        if(isset($_SESSION['user_email'])){
          ?>
          <a href="user/my_account.php?edit_account" class="get-started-btn scrollto">Profile</a> 
          <?php
        }
        else
        { 
          ?>
          <a href="login.php" class="get-started-btn scrollto">Login</a>
          <?php
        }
      ?>

      

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container">
      

      <div class="row justify-content-center">
        
       

      <div class="row gy-4 mt-5 justify-content-center">
        <div class="row">
          <div class="col-md-7 col-md-push-5">
            <div class="booking-cta">
              <h1>Make your reservation<span>.</span></h1>
              <p class="text-white">
                SUIP provides unique experience of travel ticket booking to its users. You get plenty of choices to pick
                from and we make sure you have a smooth and comfortable travel wherever you go.You can pick the sumo of
                your choice, the time you want to travel and moreover the seats you like that too in just minutes. Our
                motto is to make "traveling easier".
              </p>
            </div>
          </div>
          <div class="col-md-4 col-md-pull-7">
            <div class="booking-form">
              <form action="" method="post" class="check-sumo-form">
                <div class="form-group">
                  <span class="form-label">To</span>
                  <input class="form-control" type="text" placeholder="Enter a destination" name="to">

                  <p class="error to-error mt-2">
                      <?php echo $to_err; ?>
                    </p> 
                </div>

                <div class="form-group">
                  <span class="form-label">From</span>
                  <input class="form-control" type="text" placeholder="Enter Your Starting Point" name="from">
                    <p class="error-form from-error">
                      <?php echo $to_err; ?>
                    </p>
                </div>
                <div class="form-group">
                  <span class="form-label">Select Date</span>
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date" id="date"> 
                  <script>
                    $(document).ready(function(){
                      var date_input=$('input[name="date"]'); //our date input has the name "date"
                      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                      var options={
                        format: 'yyyy-mm-dd',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                      };
                      date_input.datepicker(options);
                    })
                </script>
                </div>
                <div class="form-group">
                  <span class="form-label">Select Time</span>
                  <input type='text' class="form-control" placeholder="HH:MM" name="time" id="datetime">
                    
                  <script>
 
        
                    $('#datetime').datetimepicker({
                        format: 'hh:mm'
                    });
                </script>
                </div>
                
                <div class="form-btn">
                  <button type="submit" name="find">Find sumo</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Check our Services</p>
        </div>

        <div class="row">
          <div class="col">

            <div class="table-responsive">
              <table class="table table-borderless" id="popular-destinations">
                <thead>
                  <tr>
                    <th class="col-md-3">Route</th>
                    <th></th>
                    <th></th>
                    <th class="col-md-4">Time</th>
                  </tr>
                </thead>
                <tbody>

                  <tr th:each="sumo : ${sumolist}">
                    <td th:text="${sumo.travelfrom}"></td>
                    <td><i class="fa fa-arrow-right"></i></td>
                    <td th:text="${sumo.travelto}"></td>
                    <td th:text="${sumo.time}"></td>

                    <td><a class="text-white btn btn-warning btn-sm"
                        href="/app/search-buses?from=Kathmandu&amp;to=Chitwan">Book tickets</a></td>
                  </tr>


                </tbody>
              </table>
            </div>

          </div>


        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Buddha Chowk, Hetauda, 44107</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>suipservices@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+977 980-2536458</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php include("includes/footer.php"); ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>