<form action="" method="post">
    <div class="tab-pane fade active show " id="account-change-password">
        <div class="card-body pb-2">

            <div class="form-group">
                <label class="form-label">Current password</label>
                <input type="password" name="old_pass" class="form-control">
                <p class="error-form to-error">
                    <?php echo $confirmation_error; ?>
                </p>
            </div>

            <div class="form-group">
                <label class="form-label">New password</label>
                <input type="password" name="new_pass" class="form-control">
                <p class="error-form to-error">
                    <?php echo $password_err; ?>
                </p>
            </div>

            <div class="form-group">
                <label class="form-label">Repeat new password</label>
                <input type="password" name="new_pass_again" class="form-control">
                <p class="error-form to-error">
                    <?php echo $confirm_password_err; ?>
                </p>
            </div>

        </div>
    </div>