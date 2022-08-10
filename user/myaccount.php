<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_email']) || !isset($_SESSION['user_id'])) {

  echo "<script>window.open('../login.php','_self')</script>";
  exit();
}






$email_err = $name_err = $contact_err =  $password_err = $confirm_password_err = $address_err = "";
$name_regex = $phone_regex = $password_regex = "";
$password = "";
$u_email = $u_contact = $u_name = $u_password = "";
$name_regex = "/^[a-zA-Z]{3,20}(?: [a-zA-Z]+){0,2}$/";
$phone_regex = "/(\+977)?[9][6-9]\d{8}/";
$password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/";
$u_image = "user.png";
$confirmation_message = "";
$confirmation_error = "";
$u_address = "";
if (isset($_POST['savechanges'])) {

  //validity check


  //check for email
  if (empty(trim($_POST["u_email"]))) {
    $email_err = "Email cannot be blank";
  } else if (!filter_var(trim($_POST["u_email"], FILTER_VALIDATE_EMAIL))) {
    $email_err = "Enter valid email";
  } else {
    $u_email = trim($_POST['u_email']);
  }

  //check for name
  if (!preg_match($name_regex, (trim($_POST['u_name'])))) {
    $name_err = "Enter Valid name";
  } else {
    $u_name = trim($_POST['u_name']);
  }

  //check for phone number
  if (!preg_match($phone_regex, (trim($_POST['u_contact'])))) {
    $contact_err = "Enter valid phone number";
  } else {
    $u_contact = trim($_POST['u_contact']);
  }

if(isset($_GET['changepassword'])){
  // Check for password
  if (!preg_match($password_regex, (trim($_POST['u_password'])))) {
    $password_err = "Enter strong password with minimum length 6";
  } else {
    $password = trim($_POST['u_password']);
  }

  // Check for confirm password field
  if (trim($_POST['u_password']) !=  trim($_POST['u_confirmpassword'])) {
    $confirm_password_err = "Passwords should match";
  }
}
  

  if (empty(trim($_POST['u_address']))) {
    $address_err = "Enter your address";
  } else {
    $u_address = trim($_POST['u_address']);
  }



  $u_password = password_hash($password, PASSWORD_DEFAULT);


  $get_email = "select * from users where user_email='$u_email'";

  $run_email = mysqli_query($con, $get_email);

  $check_email = mysqli_num_rows($run_email);

  if ($check_email == 2) {

    $email_err = "This email is already registered, try another one";
  }
  $get_contact = "select * from users where user_contact='$u_contact'";

  $run_contact = mysqli_query($con, $get_contact);

  $check_contact = mysqli_num_rows($run_contact);

  if ($check_contact == 2) {

    $contact_err = "This number is already registered, try another one";
  }

  if (empty($email_err) && empty($name_err) && empty($contact_err) && empty($password_err) && empty($address_err) && $check_email!=1) {



    $user_confirm_code = mt_rand();
    include("../mail.php");


    if (!$mail->send()) {
      $confirmation_error = "Invalid email";
    } else {
      $confirmation_message = "Check your email for account confirmation";
     
    }
    $insert_user = "insert into users(user_name,user_email,user_password,user_contact,user_image,user_address,user_confirm_code) values ('$u_name','$u_email','$u_password','$u_contact','$u_image','$u_address','$user_confirm_code')";

    if(!mysqli_query($con, $insert_user)){
      $confirmation_error = "Some error occured.";
    }
    else{
      $_SESSION['user_email'] = $u_email;
    }
  }
}






?>
<?php
include("includes/header.php");
if ($name_err != "") {
?><style>
    .name-error {
      display: block
    }
  </style><?php
        }
        if ($email_err != "") {
          ?><style>
    .email-error {
      display: block
    }
  </style><?php
        }
        if ($contact_err != "") {
          ?><style>
    .contact-error {
      display: block
    }
  </style><?php
        }
        if ($address_err != "") {
          ?><style>
    .address-error {
      display: block
    }
  </style><?php
        }
        if ($password_err != "") {
          ?><style>
    .password-error {
      display: block
    }
  </style><?php
        }
        if ($confirm_password_err != "") {
          ?><style>
    .confirmpassword-error {
      display: block
    }
  </style><?php
        }
        if ($confirmation_error != "") {
          ?><style>
    .signup-success {
      display: block;
      color: #af4242;
      background-color: #fde8ec;
    }
  </style><?php
        }
        if ($confirmation_message != "") {
          ?><style>
    .signup-success {
      display: block;
    }
  </style><?php
        }





?>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top" style="background: linear-gradient(to right, rgba(37, 117, 252, 1),rgba(106, 17, 203, 1));">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.php">SUIP<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="../index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="">Services</a></li>
          <li><a class="nav-link scrollto" href="">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="../logout.php" class="get-started-btn scrollto">Logout</a>



    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Welcome</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Profile</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <div class="container light-style flex-grow-1 container-p-y">

      <form action="" method="post">
        <div class="card overflow-hidden">
          <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-3 pt-0">
              <?php include("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-9">
              <div class="tab-content">
                <?php
                if (isset($_GET['general'])) {

                  include("general.php");
                }
                if (isset($_GET['changepassword'])) {
                  include("changepassword.php");
                }
                ?>



              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end mt-3 mb-3">
          <button type="submit" class="btn btn-warning" name="savechanges">Save changes</button>&nbsp;
        </div>
      </form>
    </div>

    <style type="text/css">
      body {
        background: whitesmoke;
        margin-top: 20px;
      }

      .ui-w-80 {
        width: 80px !important;
        height: auto;
      }

      .btn-default {
        border-color: rgba(24, 28, 33, 0.1);
        background: rgba(0, 0, 0, 0);
        color: #4E5155;
      }

      label.btn {
        margin-bottom: 0;
      }

      .btn-outline-primary {
        border-color: #26B4FF;
        background: transparent;
        color: #26B4FF;
      }

      .btn {
        cursor: pointer;
      }

      .text-light {
        color: #babbbc !important;
      }

      .btn-facebook {
        border-color: rgba(0, 0, 0, 0);
        background: #3B5998;
        color: #fff;
      }

      .btn-instagram {
        border-color: rgba(0, 0, 0, 0);
        background: #000;
        color: #fff;
      }

      .card {
        background-clip: padding-box;
        box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
      }

      .row-bordered {
        overflow: hidden;
      }

      .account-settings-fileinput {
        position: absolute;
        visibility: hidden;
        width: 1px;
        height: 1px;
        opacity: 0;
      }

      .account-settings-links .list-group-item.active {
        font-weight: bold !important;
      }

      html:not(.dark-style) .account-settings-links .list-group-item.active {
        background: transparent !important;
      }

      .account-settings-multiselect~.select2-container {
        width: 100% !important;
      }

      .light-style .account-settings-links .list-group-item {
        padding: 0.85rem 1.5rem;
        border-color: rgba(24, 28, 33, 0.03) !important;
      }

      .light-style .account-settings-links .list-group-item.active {
        color: #4e5155 !important;
      }

      .material-style .account-settings-links .list-group-item {
        padding: 0.85rem 1.5rem;
        border-color: rgba(24, 28, 33, 0.03) !important;
      }

      .material-style .account-settings-links .list-group-item.active {
        color: #4e5155 !important;
      }

      .dark-style .account-settings-links .list-group-item {
        padding: 0.85rem 1.5rem;
        border-color: rgba(255, 255, 255, 0.03) !important;
      }

      .dark-style .account-settings-links .list-group-item.active {
        color: #fff !important;
      }

      .light-style .account-settings-links .list-group-item.active {
        color: #4E5155 !important;
      }

      .light-style .account-settings-links .list-group-item {
        padding: 0.85rem 1.5rem;
        border-color: rgba(24, 28, 33, 0.03) !important;
      }
    </style>

    <script type="text/javascript">

    </script>

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
<?php

if (isset($_GET[$user_confirm_code])) {

  $update_user = "update users set user_confirm_code='' where user_confirm_code='$user_confirm_code'";

  $run_confirm = mysqli_query($con, $update_user);

  echo "<script>alert('Your Email Has Been Confirmed')</script>";

  echo "<script>window.open('myaccount.php','_self')</script>";
}

if (isset($_GET['send_email'])) {

  include("../mail.php");

  if (!$mail->send()) {
?>
    <script>
      alert("<?php echo " Error occured " ?>");
    </script>
  <?php
  } else {
  ?>
    <script>
      alert("<?php echo " Check your mail for account confirmation " ?>");
    </script>
<?php
  }

  echo "<script>window.open('myaccount.php','_self')</script>";
}
?>