<?php include("includes/db.php");
$url=$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
$parts = parse_url($url);
parse_str($parts['query'], $query);
$to= $query['to'];
$to= $query['from'];
$to= $query['date'];
$to= $query['time'];
$msg = "";
$select_sumo = "SELECT * FROM sumo where sumo_to=$to and sumo_from";
$result = mysqli_query($con, $select_sumo);
if (mysqli_num_rows($result) > 0) {
} else {
    $msg = "No Record found";
}


?>
<?php
include("includes/header.php");

?>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="assets/css/findsumo.css">
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
                    <li><a class="nav-link scrollto" href="index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="">Services</a></li>
                    <li><a class="nav-link scrollto" href="">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <?php
            if (isset($_SESSION['user_email'])) {
            ?>
                <a href="user/myaccount.php?general" class="get-started-btn scrollto">Profile</a>
            <?php
            } else {
            ?>
                <a href="login.php" class="get-started-btn scrollto">Login</a>
            <?php
            }
            ?>



        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Available Sumo</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Find Sumo</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <?php if (!empty($msg)) { ?>
                    <p>
                        <?php echo $msg; ?>
                    </p>
                <?php
                } else { ?>

                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sumo No.</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Date</th>
                                        <th>Time</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['sumo_no']; ?></td>
                                            <td><?php echo $row['sumo_from']; ?></td>
                                            <td><?php echo $row['sumo_to']; ?></td>
                                            <td><?php echo $row['sumo_date']; ?></td>
                                            <td><?php echo $row['sumo_time']; ?></td>
                                            <td><a class="text-white btn btn-warning btn-sm" href="/app/search-buses?from=Kathmandu&amp;to=Chitwan">Book ticket</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                <?php
                }
        
                ?>
            </div>
            
        </section>

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