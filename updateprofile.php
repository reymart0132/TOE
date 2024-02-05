<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
isLogin();
$view = new view;
$user = new user();
updateProfile();
 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TESDA Examination Portal</title>
   <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap.min.css">
   <link href="vendor/css/all.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css"  href="resource/css/styles.css">
   <link rel="stylesheet" type="text/css"  href="resource/css/speech.css">
   <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">

 </head>
 <body>

        <?php require_once('menu/studentmenu.php'); ?>

         <div class="container mt-5  pt-5 puff-in-center">
             <div class="row">
                 <div class="col-12">
                     <h1 class="text-center">Update your Information</h1>
                 </div>
            </div>
            <form action="" method="post">
                <table class="table ">
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <label for = "firstName" class=""> First Name</label>
                                    <input class="form-control"  type = "text" name="firstName" id="firstName" value ="<?php echo escape($user->data()->fname); ?>"/required>
                                </div>
                                <div class="form-group col-4">
                                    <label for = "lastName" class=""> Last Name</label>
                                    <input class="form-control"  type = "text" name="lastName" id="lastName" value ="<?php echo escape($user->data()->lname); ?>"/required>
                                </div>
                                <div class="form-group col-4">
                                    <label for = "middleName" class=""> Middle Name</label>
                                    <input class="form-control"  type = "text" name="middleName" id="middleName" value ="<?php echo escape($user->data()->mname); ?>"/required>
                                </div>
                                <div class="form-group col-3">
                                    <label for = "age" class=""> Age</label>
                                    <input class="form-control"  type = "text" name="age" id="age" value ="<?php echo escape($user->data()->age); ?>"/required>
                                </div>
                                <div class="form-group col-4">
                                    <label for = "phone" class=""> Phone Number</label>
                                    <input class="form-control"  type = "text" name="phone" id="phone" value ="<?php echo escape($user->data()->phone); ?>"/required>
                                </div>
                                <div class="form-group col-5">
                                    <label for = "email" class=""> Email Address</label>
                                    <input class="form-control"  type = "text" name="email" id="email" value ="<?php echo escape($user->data()->email); ?>"/required>
                                </div>
                                <div class="form-group col-12">
                                    <label for = "fullAddress" class=""> Full Address</label>
                                 <input class="form-control"  type = "text" name="faddress" id="faddress" value ="<?php echo escape($user->data()->faddress); ?>"/required>
                                </div>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-6">
                                  <label for="College" >Course to Take</label>
                                      <select id="College" name="College[]" class="selectpicker form-control" data-live-search="true" required>
                                        <?php $view->collegeSP2();?>
                                      </select>
                                </div>
                                 <div class="form-group col-6">
                                 <label for = "town" class="">Town</label>
                                <select id="town" name="town" class="selectpicker form-control" data-live-search="true" required>
                                    <?php $view->townSP(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-5">
                                    <label  >&nbsp;</label>
                                <input type="hidden" name ="Token" value="<?php echo Token::generate();?>" />
                                 <input type="submit" value="Update your profile" class=" form-control btn btn-primary" />
                                </div>
                             </div>
                        </td>
                    </tr>
                </table>
             </form>
             <!-- <form action="updatepropic.php" method="post" enctype="multipart/form-data">
                 <table class="table">
                     <tr>
                         <td>
                             <div class="row justify-content-center">
                                 <div class="form-group col-4 text-right">
                                        <?php profilePic(); ?>
                                 </div>
                                 <div class="form-group col-6">
                                     <label for="myfile">Upload your Picture</label>
                                         <input id="myfile" type="file" name="myfile" class="form-control-file" />
                                         <input type="submit" name="pic" value="Update your Picture" class=" mt-4  form-control btn btn-success" accept=".jpg" />
                                 </div>
                             </div>
                         </td>
                     </tr>
                 </table>
              </form> -->
         </div>
 </body>
     <script src="vendor/js/jquery.js"></script>
     <script src="vendor/js/popper.js"></script>
     <script src="vendor/js/bootstrap.min.js"></script>
     <script src="vendor/js/bootstrap-select.min.js"></script>
 </body>
 </html>
