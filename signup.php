<?php

session_start();
include("includes/db.php");

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
if (isset($_POST['register'])) {

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

  if (empty(trim($_POST['u_address']))) {
    $address_err = "Enter your address";
  } else {
    $u_address = trim($_POST['u_address']);
  }



  $u_password = password_hash($password, PASSWORD_DEFAULT);


  $get_email = "select * from users where user_email='$u_email'";

  $run_email = mysqli_query($con, $get_email);

  $check_email = mysqli_num_rows($run_email);

  if ($check_email == 1) {

    $email_err = "This email is already registered, try another one";
  }
  $get_contact = "select * from users where user_contact='$u_contact'";

  $run_contact = mysqli_query($con, $get_contact);

  $check_contact = mysqli_num_rows($run_contact);

  if ($check_contact == 1) {

    $contact_err = "This number is already registered, try another one";
  }

  if (empty($email_err) && empty($name_err) && empty($contact_err) && empty($password_err) && empty($address_err)) {




    $user_confirm_code = mt_rand();


    require "Mail/phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'suipservices@gmail.com';
    $mail->Password = 'qxxsxcxtrnjggwvg';

    $mail->setFrom('suipservices@gmail.com', 'Verify Email');
    // get email from input
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
      $confirmation_error = "Invalid email";
    } else {
      $confirmation_message = "Check your email for account confirmation";
      $insert_user = "insert into users(user_name,user_email,user_password,user_contact,user_image,user_address,user_confirm_code) values ('$u_name','$u_email','$u_password','$u_contact','$u_image','$u_address','$user_confirm_code')";

      $run_user = mysqli_query($con, $insert_user);


      $_SESSION['user_email'] = $u_email;
    }
  }
}
?>

<?php
include("includes/header.php");
?>

<link href="assets/css/form.css" rel="stylesheet">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- Include Moment.js CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<!-- Include Bootstrap DateTimePicker CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<?php
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
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.php">SUIP<span>.</span></a></h1>
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

      <a href="login.php" class="get-started-btn scrollto">Login</a>

    </div>
  </header><!-- End Header -->

  <section class="signup">
    <div class="container h-100" style="margin-top: 20px;">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-5">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="d-flex flex-row align-items-center">
                <div class="flex-fill mb-0">
                  <p class="success signup-success text-center">
                    <?php echo (isset($confirmation_message)) ? $confirmation_message : $confirmation_error ?>
                  </p>
                </div>
              </div>
              <div class="col-md-10 col-lg-6 col-xl-12 order-2 order-lg-1">
                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4">Sign up</p>

                <form action="" method="post" class="signup-form">

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_name" class="form-control" placeholder="Full Name" type="text" value="<?php echo (isset($u_name)) ? $u_name : '' ?>">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa- fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <p class="error name-error">
                        <?php echo $name_err; ?>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_email" placeholder="Email" class="form-control" type="email" value="<?php echo (isset($u_email)) ? $u_email : '' ?>">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa- fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <p class="error email-error">
                        <?php echo $email_err; ?>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_contact" placeholder="Phone Number" class="form-control" type="text" value="<?php echo (isset($u_contact)) ? $u_contact : '' ?>">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa- fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <p class="error contact-error">
                        <?php echo $contact_err; ?>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-map fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_address" placeholder="Address" class="form-control" type="text" value="<?php echo (isset($u_address)) ? $u_address : '' ?>">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa- fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <p class="error address-error">
                        <?php echo $address_err; ?>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_password" class="form-control" placeholder="Password" type="password">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa- fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <p class="error password-error">
                        <?php echo $password_err; ?>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-check fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_confirmpassword" class="form-control" placeholder="Confirm password" type="password">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa- fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <p class="error confirmpassword-error">
                        <?php echo $confirm_password_err; ?>
                      </p>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-4">
                    <input type="checkbox" name="agreement" class="form-check-input me-2" required>
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="register">Register</button>
                  </div>

                </form>
                <div>
                  <p class="mb-0">Already have an account? <a href="login.php" class="fw-bold">Login</a></p>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>