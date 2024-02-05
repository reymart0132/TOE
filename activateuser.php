<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isUser($user->data()->groups);
$errorMsg ='';

if(!empty($_POST['code'])) {
  if($user->data()->code == $_POST['code']) {
    $activator = new activator($user->data()->id);
    $activator->activateUser();
    header('Location:userdashboard.php');
  }else{
    $errorMsg ="Please enter a valid code or Ask help to the instructor available.";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TESDA Examination Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap.min.css">
  <script src="vendor/js/jquery.js"></script>
  <link href="vendor/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css"  href="resource/css/styles.css">
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>

</head>
<body>
        <?php require_once('menu/studentmenu.php');?>
        <div class="container mt-4 puff-in-center">
          <div class="row justify-content-center">
            <div class="col-12"> 
              <form action="" method="POST">
                <div class="form-group col-12">
                  <?php
                  if($errorMsg !=='') {
                    echo "<b class='text-danger'>$errorMsg</b>";
                  }
                  ?>
                                 <label for = "code" class=""> Enter the activation code that was sent to your email address(<b><?php echo $user->data()->email; ?></b>)</label>
                                 <input class="form-control"  type = "text" name="code" id="code" value ="" /required>
                                 <input type="submit" class="btn btn-primary col-12"/>
                </div>           
              </form>
            </div>
          </div>
        </div>
      
      </body> 
   
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>
</body>
</html>
