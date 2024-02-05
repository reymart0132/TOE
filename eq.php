<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
$view = new view();
isAdmin($user->data()->groups);
insertQuestion();
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
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
    <script src="vendor/js/jquery.js"></script>
    <link href="vendor/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="resource/css/styles.css">
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap-select.min.css">
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

    <?php require_once('menu/adminmenu.php'); ?>
<div class="container-fluid mt-4 puff-in-center">
    <?php
    if (!empty($_GET)) {
        CheckSuccessQuestion($_GET['status']);
    }
    ?>
    <div class="row">
    <div class="col-md-12 card1 p-3">
        <h3 class="text-center">Add New Exam Question</h3>
        <br>
        <div class="box">
        <form method="post">
        <div class="form-group">
            <label for="question">Insert your question here</label>
        <textarea id="content" name="content" class="form-control"></textarea>
        <small id="question" class="form-text text-muted">Type your question above.</small>
        </div>
        <div class="row justify-content-center">
                    <div class="form-group col-md-2">
                        <label for="question">Choice A</label>
                        <textarea rows="4" class="form-control" id="" name="choice1" required> </textarea>
                        <small id="question" class="form-text text-muted">Enter Choice A above.</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="question">Choice B</label>
                        <textarea rows="4" class="form-control" id="" name="choice2" required> </textarea>
                        <small id="question" class="form-text text-muted">Enter Choice B above.</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="question">Choice C</label>
                        <textarea rows="4" class="form-control" id="" name="choice3" required> </textarea>
                        <small id="question" class="form-text text-muted">Enter Choice C above.</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="question">Choice D</label>
                        <textarea rows="4" class="form-control" id="" name="choice4" required> </textarea>
                        <small id="question" class="form-text text-muted">Enter Choice D above.</small>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="question">Select the Correct Answer</label><br>
                        <input type="radio" id="answer" name="answer" value="a" required>A<br>
                        <input type="radio" id="answer" name="answer" value="b" required>B<br>
                        <input type="radio" id="answer" name="answer" value="c" required>C<br>
                        <input type="radio" id="answer" name="answer" value="d" required>D<br>
                         
                            
</input>
                    </div> 
        <div class="form-group">
            <div class="form-group col-md-12">
            <label for="question">Select the Exam Type</label>
                <select id="type" name="type" class="form-control"  required>
                <option value="aptitude1"><?php echo getExamName('aptitude1') ?>
            </option>
            <option value="aptitude2">
                <?php echo getExamName('aptitude2') ?>
            </option>
            <option value="aptitude3">
                <?php echo getExamName('aptitude3') ?>
            </option>
            <option value="aptitude4">
                <?php echo getExamName('aptitude4') ?>
            </option>
            <option value="aptitude5">
                <?php echo getExamName('aptitude5') ?>
            </option>
            </select>
         </div>
        </div>
  <input  class="btn btn-info btn-large col-12 mb-5"type="submit" name="submit" value="Save">
  </form>
  <div class="error"><?php if (!empty($msg)) {
                    echo $msg;
                } ?>
            </div>
        </div>
    </div>
        <?php $viewtable->viewExamTable(); ?>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>
    <script>
    $(document).ready(function(){
      window.$('#examTable').DataTable({        
        });
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ),{
          ckfinder:
          {
            uploadUrl: 'fileupload.php'
          }
        })
        .then(editor => {
          console.log(editor);
        })
        .catch( error => {
            console.error( error );
        });
</script>
</body>
</html>
</body>

</html>