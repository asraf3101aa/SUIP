<?php
session_start();
include("includes/db.php");

?>
<?php
$u_email = $_SESSION['user_email'];

$get_user = "select * from users where user_email='$u_email'";

$run_user = mysqli_query($con, $get_user);

$row_user = mysqli_fetch_array($run_user);

$user_confirm_code = $row_user['user_confirm_code'];
if (isset($_GET[$user_confirm_code])) {

  $update_user = "update users set user_confirm_code='' where user_confirm_code='$user_confirm_code'";

  $run_confirm = mysqli_query($con, $update_user);

  echo "<script>alert('Your Email Has Been Confirmed')</script>";

  header("Location: myaccount.php?general");
}


?>