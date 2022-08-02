<?php
session_start();
include("includes/db.php");
$login_fail=null;
if (isset($_POST['login'])) {

    $u_email = $_POST['u_email'];

    $u_password = $_POST['u_password'];

    

    $select_user = "select * from users where user_email='$u_email'";

    $run_user = mysqli_query($con, $select_user);


    $data = mysqli_fetch_assoc($run_user);
    $hash_password = $data['user_password'];
    if (!password_verify($u_password, $hash_password)) {
        $login_fail="Invalid email or password";
    } 
    else {
        

        $_SESSION['user_email'] = $u_email;

        echo "<script>window.open('user/my_account.php?my_orders','_self')</script>";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<?php
  if($login_fail!=null){
    ?><style>.login-error{display: block;}</style><?php
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

      <a href="signup.php" class="get-started-btn scrollto">Sign Up</a>

    </div>
  </header><!-- End Header -->

  <section class="login">
    <div class="container h-100" style="margin-top: 20px;">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-5">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
            <div class="d-flex flex-row align-items-center">
              <div class="flex-fill mb-0">
                <p class="error login-error text-center">
                <?php echo $login_fail;?>
                </p>                   
              </div>
            </div>
              <div class="col-md-10 col-lg-6 col-xl-12 order-2 order-lg-1">
                
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                <form action="" method="post" class="login-form">

                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_email" placeholder="Email" class="form-control" type="email" value="<?php echo (isset($u_email)) ? $u_email: ''?>">
                    </div>
                  </div>



                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="u_password" class="form-control" placeholder="Password" type="password">
                    </div>
                  </div>



                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="login">Login</button>
                  </div>

                </form>
                <div>
                  <p class="mb-2">Forgot Password? <a href="" class="fw-bold">Reset here</a></p>
                </div>
                <div>
                  <p class="mb-0">Dont have an account? <a href="signup.php" class="fw-bold">Signup</a></p>
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

