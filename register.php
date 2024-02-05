<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
$view = new view;
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
   <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">

 </head>
 <body>
        <?php require_once ('menu/homemenu.php')?>

         <div class="container mt-4 puff-in-center">
             <div class="row">
                 <div class="col-12">
                     <h1 class="text-center">Examinee Registration</h1>
                 </div>
            </div>
            <?php
                vald();
            ?>
            <form action="" method="post">
                <table class="table ">
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                 <label for = "username" class=""> Username:</label>
                                 <input class="form-control"  type = "text" name="username" id="username" value ="<?php echo input::get('username');?>" autocomplete="off" required />
                                </div>
                                <div class="form-group col-4">
                                 <label for = "password"> Password:</label>
                                 <input type="password" class="form-control" name="password" id="password" value ="<?php echo input::get('password');?>" autocomplete="off"required/>
                                </div>
                                <div class="form-group col-4">
                                 <label for = "ConfirmPassword"> Confirm Password:</label>
                                 <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" value ="<?php echo input::get('ConfirmPassword');?>" autocomplete="off"required/>
                                </div>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                 <label for = "firstName" class=""> First Name</label>
                                 <input class="form-control"  type = "text" name="firstName" id="firstName"  value ="<?php echo input::get('firstName');?>"/required>
                                </div>
                                <div class="form-group col-4">
                                 <label for = "lastName" class=""> Last Name</label>
                                 <input class="form-control"  type = "text" name="lastName" id="lastName"  value ="<?php echo input::get('lastName');?>"/required>
                                </div>
                                <div class="form-group col-4">
                                 <label for = "middleName" class=""> Middle Name</label>
                                 <input class="form-control"  type = "text" name="middleName" id="middleName"  value ="<?php echo input::get('middleName');?>">
                                </div>
                                <div class="form-group col-4">
                                 <label for = "contactNumber" class=""> Contact Number </label>
                                 <input class="form-control"  type = "text" name="contactNumber" id="contactNumber"  value ="<?php echo input::get('contactNumber');?>"/required>
                                </div>
                                <div class="form-group col-1">
                                 <label for = "age" class=""> Age </label>
                                 <input class="form-control"  type = "number" name="age" id="age"  value ="<?php echo input::get('age');?>" max="150" min="10" maxlength="2" /required>
                                </div>
                                <div class="form-group col-2">
                                    <label for = "town" class="">Gender</label>
                                    <select id="gender"  name="gender" class="selectpicker form-control" data-live-search="true" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">LGBT/Others</option>
                                    </select>
                                </div>
                                <div class="form-group col-5">
                                    <label for="College" >Course to take:</label>
                                    <select id="College"  name="College[]" class="selectpicker form-control" data-live-search="true" required>
                                        <?php $view->collegeSP2();?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                 <label for = "age" class=""> Full Address </label>
                                 <input class="form-control"  type = "text" name="fullAddress" id="fullAddress"  value ="<?php echo input::get('fullAddress');?>" /required>
                                </div>
                                <div class="form-group col-6">
                                 <label for = "email" class=""> Email Address</label>
                                 <input class="form-control"  type = "text" name="email" id="email" value ="<?php echo input::get('email');?>"/required>
                                </div>
                                <div class="form-group col-6">
                                 <label for = "town" class="">Town</label>
                                <select id="town"  name="town" class="selectpicker form-control" data-live-search="true" required>
                                    <?php $view->townSP(); ?>
                                </select>
                                </div>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-12 text-muted">
                                   <p>In compliance with the <strong>Data Privacy Act of 2012</strong> (R.A. No. 10173, Chapter 1, Section 2),</p>
                                <em>*By submitting this form, you grant us permission to use your data for research and communication purposes only.</em>
                                </div>
                                <div class="form-group col-7">
                                    <label  >&nbsp;</label>
                                <input type="hidden" name ="Token" value="<?php echo Token::generate();?>" />
                                <label>
                                     <input type="checkbox" id="termsCheckbox" required>
                                         I agree to the terms and conditions</a>.
                                </label>
                                 <input type="submit" onclick="submitForm()" value="Submit Profile" class=" form-control btn btn-primary" />
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
             </form>
         </div>


         <script>
        function submitForm() {
        // Check if the terms and conditions checkbox is checked
        var termsCheckbox = document.getElementById("termsCheckbox");
        if (!termsCheckbox.checked) {
            alert("You must agree to the terms and conditions before submitting.");
            return;
        }

        // Retrieve form data and perform further processing (e.g., send to server)
        var username = document.getElementById("firstName").value;
        var email = document.getElementById("lastName").value;
        var password = document.getElementById("middleName").value;
        var password = document.getElementById("contactNumber").value;
        var password = document.getElementById("age").value;
        var password = document.getElementById("gender").value;
        var password = document.getElementById("College").value;
        var password = document.getElementById("fullAddress").value;
        var password = document.getElementById("email").value;
        var password = document.getElementById("town").value;

        
    }
    </script>


 </body>
     <script src="vendor/js/jquery.js"></script>
     <script src="vendor/js/popper.js"></script>
     <script src="vendor/js/bootstrap.min.js"></script>
     <script src="vendor/js/bootstrap-select.min.js"></script>
 </body>
 </html>
