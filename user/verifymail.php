<?php
    if (isset($_GET[$user_confirm_code])) {

        $update_user = "update users set user_confirm_code='' where user_confirm_code='$user_confirm_code'";
      
        $run_confirm = mysqli_query($con, $update_user);
      
        echo "<script>alert('Your Email Has Been Confirmed')</script>";
      
        header("Location: myaccount.php?general");
      }

      
?>