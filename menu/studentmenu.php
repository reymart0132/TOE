<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
$user = new user();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <img src="resource/img/tesdalogo1.jpg" height="72px;" alt="tesda logo">
    <div class="logotesda"><h1>TESDA</h1> </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            
            <a class="nav-item nav-link" href="userdashboard.php">Home</a>
            <a class="nav-item nav-link" href="updateprofile.php">Update Information</a>
            <a class="nav-item nav-link" href="changepassword.php">Change Password</a>
            <a class="nav-item nav-link" href="logout.php">Logout</a>
            <a class="nav-item nav-link">User: <b><?php echo $user->data()->fname." ".$user->data()->lname.""; ?></b></a>
        </div>
    </div>
</nav> 