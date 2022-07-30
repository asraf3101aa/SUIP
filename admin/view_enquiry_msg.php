<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>


    <div class="row">
        <!-- 1 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <ol class="breadcrumb">
                <!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / View Enquiry Messages

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->


    <div class="row">
        <!-- 2 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <div class="panel panel-default">
                <!-- panel panel-default Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <h3 class="panel-title">
                        <!-- panel-title Starts -->

                        <i class="fa fa-money fa-fw"> </i> View View Enquiry Messages

                    </h3><!-- panel-title Ends -->

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <div class="table-responsive">
                        <!-- table-responsive Starts -->

                        <table class="table table-bordered table-hover table-striped">
                            <!-- table table-bordered table-hover table-striped Starts -->

                            <thead>
                                <!-- thead Starts -->

                                <tr>

                                    <th>Message Id</th>
                                    <th>Sender Name</th>
                                    <th>Sender Email</th>
                                    <th>Enquiry type</th>
                                    <th>Message Subject</th>
                                    <th>Message</th>


                                </tr>

                            </thead><!-- thead Ends -->

                            <tbody>
                                <!-- tbody Starts -->

                                <?php

                                $i = 0;

                                $get_messages = "select * from contact_messages";

                                $run_messages = mysqli_query($con, $get_messages);

                                while ($row_messages = mysqli_fetch_array($run_messages)) {

                                    $message_id = $row_messages['message_id'];

                                    $message_sender_name = $row_messages['sender_name'];

                                    $message_sender_email = $row_messages['message_from'];

                                    $message_enquiry_type = $row_messages['enquiry_type'];

                                    $message_subject = $row_messages['message_subject'];

                                    $message = $row_messages['message_content'];

                                    $i++;

                                ?>

                                    <tr>

                                        <td> <?php echo $i; ?> </td>

                                        <td> <?php echo $message_sender_name; ?> </td>

                                        <td> <?php echo $message_sender_email; ?> </td>

                                        <td> <?php echo $message_enquiry_type; ?> </td>

                                        <td> <?php echo $message_subject; ?> </td>

                                        <td> <?php echo $message; ?> </td>                                        


                                    </tr>

                                <?php } ?>

                            </tbody><!-- tbody Ends -->

                        </table><!-- table table-bordered table-hover table-striped Ends -->

                    </div><!-- table-responsive Ends -->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->



<?php } ?>