<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {




?>

<?php

if(isset($_GET['wholesaler_delete'])){

$delete_id = $_GET['wholesaler_delete'];

$delete_customer = "delete from wholesaler where wholesaler_id='$delete_id'";

$run_delete = mysqli_query($con,$delete_customer);


if($run_delete){

echo "<script>alert('Wholesaler Has Been Deleted')</script>";

echo "<script>window.open('index.php?view_wholesaler','_self')</script>";


}

}


?>




<?php } ?>