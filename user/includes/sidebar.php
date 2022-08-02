<div class="panel panel-default sidebar-menu">
    <!-- panel panel-default sidebar-menu Starts -->

    <div class="panel-heading">
        <!-- panel-heading Starts -->

        <?php

        $user_session = $_SESSION['user_email'];

        $get_user = "select * from users where user_email='$user_session'";

        $run_user = mysqli_query($con, $get_user);

        $row_user = mysqli_fetch_array($run_user);

        $user_image = $row_user['user_image'];

        $user_name = $row_user['user_name'];

        if (!isset($_SESSION['user_email'])) {
        } else {

            echo "

<center>

<img src='user_images/$user_image' class='img-responsive'>

</center>

<br>

<h3 align='center' class='panel-title'> Name : $user_name </h3>

";
        }

        ?>

    </div><!-- panel-heading Ends -->

    <div class="panel-body">
        <!-- panel-body Starts -->

        <ul class="nav nav-pills nav-stacked">
            <!-- nav nav-pills nav-stacked Starts -->

            <li class="<?php if (isset($_GET['my_orders'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?my_orders"> <i class="fa fa-list"> </i> Bookings </a>

            </li>


            <li class="<?php if (isset($_GET['edit_account'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?edit_account"> <i class="fa fa-pencil"></i> Edit Account </a>

            </li>

            <li class="<?php if (isset($_GET['change_pass'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?change_pass"> <i class="fa fa-user"></i> Change Password </a>

            </li>

           

            <li class="<?php if (isset($_GET['delete_account'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?delete_account"> <i class="fa fa-trash-o"></i> Delete Account </a>

            </li>

            <li>

                <a href="logout.php"> <i class="fa fa-sign-out"></i> Logout </a>

            </li>


        </ul><!-- nav nav-pills nav-stacked Ends -->

    </div><!-- panel-body Ends -->

</div><!-- panel panel-default sidebar-menu Ends -->