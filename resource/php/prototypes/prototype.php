<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
$view = new view();
isAdmin($user->data()->groups);

if (isset($_REQUEST['submit'])) {
    $content = $_REQUEST['content'];
    $type = $_REQUEST['type'];

    $config = new config;
    $con = $config->con();
    $sql = "INSERT INTO `tbl_question` SET `question` = '$content',`type`='$type' ";
    $data = $con->prepare($sql);
    if($data->execute())
    {
      $msg = "The new Question has been inserted please add answer using the edit function seen on the table below";
    }
    else
    {
      $msg = "Error";
    }
  }
?>

<html>  
<head>  
    <title>Ckeditor</title>  
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
    <script src="vendor/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="resource/css/styles.css">
    <style>
        .box
        {
        width:100%;
        background-color:#f9f9f9;
        border:1px solid #ccc;
        border-radius:5px;
        padding:16px;
        margin:0 auto;
        }
        .ck-editor__editable[role="textbox"] {
                        /* editing area */
                        min-height: 300px;
                    }
        .error
        {
        color:  red;
        }
    </style>
</head>
<body>
<div class="container">
  <h3 class="text-center">Add New Exam Question</h3>
  <br>
  <div class="box">
  <form method="post">
  <div class="form-group">
  <textarea id="content" name="content" class="form-control"></textarea>
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
  <input type="submit" name="submit" value="Save" class="btn btn-primary">
  </div>
  </form>
  <div class="error"><?php if (!empty($msg)) {
                    echo $msg;
                } ?>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"></script>
<script src="vendor/js/bootstrap.min.js"></script>
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


