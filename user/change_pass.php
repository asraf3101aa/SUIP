<h1 align="center">Change Password </h1>

<form action="" method="post">
    <!-- form Starts -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label>Enter Your Current Password</label>

        <input type="text" name="old_pass" class="form-control" required>

    </div><!-- form-group Ends -->


    <div class="form-group">
        <!-- form-group Starts -->

        <label>Enter Your New Password</label>

        <input type="text" name="new_pass" class="form-control" required>

    </div><!-- form-group Ends -->


    <div class="form-group">
        <!-- form-group Starts -->

        <label>Enter Your New Password Again</label>

        <input type="text" name="new_pass_again" class="form-control" required>

    </div><!-- form-group Ends -->

    <div class="text-center">
        <!-- text-center Starts -->

        <button type="submit" name="submit" class="btn btn-primary">

            <i class="fa fa-user-md"> </i> Change Password

        </button>

    </div><!-- text-center Ends -->

</form><!-- form Ends -->
<?php

if (isset($_POST['submit'])) {

    $u_email = $_SESSION['user_email'];

    $old_pass = trim($_POST['old_pass']);

    $new_pass = trim($_POST['new_pass']);

    $new_pass_again = trim($_POST['new_pass_again']);

    $sel_old_pass = "select * from users where user_email='$u_email'";

    $run_old_pass = mysqli_query($con, $sel_old_pass);

    $check_old_pass = mysqli_num_rows($run_old_pass);

    $data = mysqli_fetch_assoc($run_old_pass);
    $hash_password = $data["user_pass"];

    if (!password_verify($old_pass, $hash_password)) {

        echo "<script>alert('Your Current Password is not valid try again')</script>";

        exit();
    }

    if ($new_pass != $new_pass_again) {

        echo "<script>alert('Your new Password does not match')</script>";

    }
    else{
        $password_set = password_hash($new_pass,PASSWORD_DEFAULT);
        $update_pass = "update customers set user_pass='$password_set' where user_email='$u_email'";

    $run_pass = mysqli_query($con, $update_pass);

        if ($run_pass) {

            echo "<script>alert('your Password Has been Changed Successfully')</script>";

            echo "<script>window.open('my_account.php?my_orders','_self')</script>";
        }
    }
    
}



?>