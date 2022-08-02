<?php

$user_session = $_SESSION['user_email'];

$get_user = "select * from users where user_email='$user_session'";

$run_user = mysqli_query($con, $get_user);

$row_user = mysqli_fetch_array($run_user);

$user_id = $row_user['user_id'];

$user_name = $row_user['user_name'];

$user_email = $row_user['user_email'];

$user_contact = $row_user['user_contact'];

$user_image = $row_user['user_image'];

$user_confirm_code = $row_user['user_confirm_code'];

?>

<h1 align="center"> Edit Your Account </h1>

<form action="" method="post" enctype="multipart/form-data">
    <!--- form Starts -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Your Name: </label>

        <input type="text" name="u_name" class="form-control" required value="<?php echo $user_name; ?>" <?php echo (isset($user_confirm_code)) ? 'disabled': '' ?>>


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Email: </label>

        <input type="text" name="u_email" class="form-control" required value="<?php echo $user_email; ?>" <?php echo (isset($user_confirm_code)) ? 'disabled': '' ?>>


    </div><!-- form-group Ends -->




    <div class="form-group">
        <!-- form-group Starts -->

        <label> Contact: </label>

        <input type="text" name="u_contact" class="form-control" required value="<?php echo $user_contact; ?>" <?php echo (isset($user_confirm_code)) ? 'disabled': '' ?>>


    </div><!-- form-group Ends -->



    <div class="form-group">
        <!-- form-group Starts -->

        <label> Profile Picture: </label>

        <input type="file" name="u_image" class="form-control" <?php echo (isset($user_confirm_code)) ? 'disabled': '' ?>><br>

        <img src="user_images/<?php echo $user_image; ?>" width="100" height="100" class="img-responsive">


    </div><!-- form-group Ends -->

    <div class="text-center">
        <!-- text-center Starts -->

        <button name="update" class="btn btn-primary">

            <i class="fa fa-user-md"></i> Update Now

        </button>


    </div><!-- text-center Ends -->


</form>
<!--- form Ends -->

<?php

if (isset($_POST['update'])) {

    $update_id = $user_id;

    $u_name = $_POST['u_name'];

    $u_email = $_POST['u_email'];

    $u_contact = $_POST['u_contact'];

    $u_image = $_FILES['u_image']['name'];

    $u_image_tmp = $_FILES['u_image']['tmp_name'];

    move_uploaded_file($u_image_tmp, "user_images/$u_image");

    if($u_image==''){
        $u_image=$user_image;
    }

    $update_user = "update users set user_name='$u_name',user_email='$u_email',user_contact='$u_contact',user_image='$u_image' where user_id='$update_id'";

    $run_user = mysqli_query($con, $update_user);

    if ($run_user) {

        echo "<script>alert('Your account has been updated')</script>";
    }
}


?>