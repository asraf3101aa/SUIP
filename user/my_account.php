<?php

session_start();

if (!isset($_SESSION['user_email'])) {

  echo "<script>window.open('./login.php','_self')</script>";
} else {

  include("../includes/db.php");
  include("includes/header.php");


?>
  <link href="../assets/css/myaccstyle.css" rel="stylesheet">
  </head>

  <body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
      <div class="container d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="../index.php">SUIP<span>.</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a class="nav-link scrollto" href="index.php">Home</a></li>
            <li><a class="nav-link scrollto" href="index.php">Services</a></li>
            <li><a class="nav-link scrollto" href="index.php">Contact</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="../signup.php" class="get-started-btn scrollto">Sign Up</a>

      </div>
    </header><!-- End Header -->

    <main id="main">

      <!-- ======= Breadcrumbs ======= -->
      <section class="breadcrumbs">
        <div class="container">

          <div class="d-flex justify-content-between align-items-center">
            <h2>My Account</h2>
            <ol>
              <li><a href="../index.php">Home</a></li>
              <li>Profile</li>
            </ol>
          </div>

        </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
        <div id="content">
          <!-- content Starts -->
          <div class="container">
            <!-- container Starts -->



            <div class="col-md-12">
              <!-- col-md-12 Starts -->

              <?php

              $u_email = $_SESSION['user_email'];

              $get_user = "select * from users where user_email='$u_email'";

              $run_user = mysqli_query($con, $get_user);

              $row_user = mysqli_fetch_array($run_user);

              $user_confirm_code = $row_user['user_confirm_code'];

              $u_name = $row_user['user_name'];

              if (!empty($user_confirm_code)) {

              ?>

                <div class="alert alert-danger text-center">
                  <!-- alert alert-danger Starts -->

                  <strong> Warning! </strong> Please Confirm Your Email and if you have not received your confirmation email

                  <a href="my_account.php?send_email" class="alert-link">

                    Send Email Again

                  </a>

                </div><!-- alert alert-danger Ends -->

              <?php } ?>

            </div><!-- col-md-12 Ends -->

            <div class="col-md-3">
              <!-- col-md-3 Starts -->

              <?php include("includes/sidebar.php"); ?>

            </div><!-- col-md-3 Ends -->

            <div class="col-md-9">
              <!--- col-md-9 Starts -->

              <div class="box">
                <!-- box Starts -->

                <?php

                if (isset($_GET[$user_confirm_code])) {

                  $update_user = "update users set user_confirm_code='' where user_confirm_code='$user_confirm_code'";

                  $run_confirm = mysqli_query($con, $update_user);

                  echo "<script>alert('Your Email Has Been Confirmed')</script>";

                  echo "<script>window.open('my_account.php?my_orders','_self')</script>";
                }

                if (isset($_GET['send_email'])) {

                  require "../Mail/phpmailer/PHPMailerAutoload.php";
                  $mail = new PHPMailer;

                  $mail->isSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->Port = 587;
                  $mail->SMTPAuth = true;
                  $mail->SMTPSecure = 'tls';

                  $mail->Username = 'suipservices@gmail.com';
                  $mail->Password = 'qxxsxcxtrnjggwvg';

                  $mail->setFrom('suipservices@gmail.com', 'Verify Email');
                  $mail->addAddress($u_email);

                  // HTML body
                  $mail->isHTML(true);
                  $mail->Subject = "Email Confirmation Message";
                  $mail->Body = "

                  <h2>
                  Email Confirmation By SUIP
                  </h2>
                  
                  <a href='localhost/suip/user/my_account.php?$user_confirm_code'>
                  
                  Click Here To Confirm Email
                  
                  </a>
                  
                  ";

                  if (!$mail->send()) {
                ?>
                    <script>
                      alert("<?php echo " Invalid Email " ?>");
                    </script>
                  <?php
                  } else {
                  ?>
                    <script>
                      alert("<?php echo " Check your mail for account confirmation " ?>");
                    </script>
                <?php
                  }

                  echo "<script>window.open('my_account.php?my_orders','_self')</script>";
                }



                if (isset($_GET['my_orders'])) {

                  include("my_orders.php");
                }

                if (isset($_GET['insert_product'])) {

                  include("insert_product.php");
                }

                if (isset($_GET['edit_account'])) {

                  include("edit_account.php");
                }

                if (isset($_GET['change_pass'])) {

                  include("change_pass.php");
                }

                if (isset($_GET['delete_account'])) {

                  include("delete_account.php");
                }

                if (isset($_GET['my_products'])) {

                  include("view_products.php");
                }

                if (isset($_GET['delete_product'])) {

                  include("delete_product.php");
                }

                if (isset($_GET['edit_product'])) {

                  include("edit_product.php");
                }

                ?>

              </div><!-- box Ends -->


            </div>
            <!--- col-md-9 Ends -->

          </div><!-- container Ends -->
        </div><!-- content Ends -->
      </section>

    </main><!-- End #main -->



    <?php

    include("../includes/footer.php");

    ?>

    <script src="js/jquery.min.js"> </script>

    <script src="js/bootstrap.min.js"></script>

  </body>

  </html>
<?php } ?>