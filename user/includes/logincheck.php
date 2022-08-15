<?php
if (!isset($_SESSION['user_email']) && !isset($_SESSION['user_id'])) {

    echo "<script>window.open('../login.php','_self')</script>";
  }
?>