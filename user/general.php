<?php
$u_email = $_SESSION['user_email'];

$get_user = "select * from users where user_email='$u_email'";

$run_user = mysqli_query($con, $get_user);

$row_user = mysqli_fetch_array($run_user);


$user_confirm_code = $row_user['user_confirm_code'];

$u_name = $row_user['user_name'];
$u_email = $row_user['user_email'];
$u_contact = $row_user['user_contact'];
$u_address = $row_user['user_address'];
$u_image = $row_user['user_image'];
?>


<form action="" method="post">

    <div class="tab-pane fade active show" id="account-general">

        <p class="success signup-success text-center">
            <?php echo (isset($confirmation_message)) ? $confirmation_message : $confirmation_error ?>
        </p>

        <div class="card-body media align-items-center">
            <img src="<?php echo (isset($u_image)) ? 'avatar/' . $u_image : "https://bootdey.com/img/Content/avatar/avatar6.png" ?>" alt="" class="d-block ui-w-80">
            <div class="media-body ml-4 mt-2">
                <label class="btn btn-warning">
                    Upload new photo
                    <input type="file" name="u_image" class="account-settings-fileinput">
                </label> &nbsp;
                <button type="button" class="btn btn-default md-btn-flat">Reset</button>

            </div>
        </div>
        <hr class="border-light m-0">

        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control mb-1" name="u_name" value="<?php echo (isset($u_name)) ? $u_name : '' ?>" <?php echo (!empty($user_confirm_code)) ? 'disabled' : '' ?>>
                <p class="error-form name-error">
                    <?php echo $name_err; ?>
                </p>
            </div>
            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control mb-1" name="u_email" value="<?php echo (isset($u_email)) ? $u_email : '' ?>" <?php echo (!empty($user_confirm_code)) ? 'disabled' : '' ?>>
                <p class="error-form email-error">
                    <?php echo $email_err; ?>
                </p>
                <?php

                if (!empty($user_confirm_code)) {

                ?>
                    <div class="alert alert-warning mt-3">
                        Your email is not confirmed.
                        <a href="myaccount.php?send_email">Resend confirmation</a>


                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label class="form-label">Phone No.</label>
                <input type="text" class="form-control" name="u_contact" value="<?php echo (isset($u_contact)) ? $u_contact : '' ?>" <?php echo (!empty($user_confirm_code)) ? 'disabled' : '' ?>>
                <p class="error-form contact-error">
                    <?php echo $contact_err; ?>
                </p>
            </div>
            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="u_address" value="<?php echo (isset($u_address)) ? $u_address : '' ?>" <?php echo (!empty($user_confirm_code)) ? 'disabled' : '' ?>>
                <p class="error-form address-error">
                    <?php echo $address_err; ?>
                </p>
            </div>
        </div>

    </div>