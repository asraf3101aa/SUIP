<div class="list-group list-group-flush account-settings-links">
    <a class="list-group-item list-group-item-action <?php if(isset($_GET['general'])){ echo "active"; } ?>" data-toggle="list" href="myaccount.php?general">General</a>
    <a class="list-group-item list-group-item-action <?php if(isset($_GET['changepassword'])){ echo "active"; } ?>" data-toggle="list" href="myaccount.php?changepassword">Change password</a>
    <a class="list-group-item list-group-item-action <?php if(isset($_GET['deleteaccount'])){ echo "active"; } ?>" data-toggle="list" href="myaccount.php?deleteaccount">Delete account</a>
    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Notifications</a>
</div>