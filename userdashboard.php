<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isUser($user->data()->groups);
isActive($user->data()->active);
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
            <div class="col-12 card1 p-5 mr-5 shadow-sm">
              <h3 class="text-center m-2 "> Take Aptitude Examination</h3>
              <small class="text-muted"> Please click on the exam link below on the exam that you want to take.</small>
              <?php
                if ($user->data()->aptitude1 == 0) {
                  echo "<a class='btn btn-primary w-100 mb-1' target='_blank' href='userexam.php?type=aptitude1'>". getExamName('aptitude1')."</a>";
                  echo "  <div class='alert alert-secondary'>
                        ".getExamDesc('aptitude1')."
                      </div>";
                 
                } else {
                  echo "<a class='btn btn-large btn-secondary disabled w-100 mb-1' href='#' >" . getExamName('aptitude1') . "- Completed!</a>";
                }
                if ($user->data()->aptitude2 == 0) {
                  echo "<a class='btn btn-primary w-100 mb-1' target='_blank' href='userexam.php?type=aptitude2'>" . getExamName('aptitude2') . "</a>";
                echo "  <div class='alert alert-secondary'>
                        " . getExamDesc('aptitude2') . "
                      </div>";
                } else {
                  echo "<a class='btn btn-large btn-secondary disabled w-100 mb-1' href='#' >" . getExamName('aptitude2') . "!</a>";
                }
                if ($user->data()->aptitude3 == 0) {
                  echo "<a class='btn btn-primary w-100 mb-1' target='_blank' href='userexam.php?type=aptitude3'>" . getExamName('aptitude3') . "</a>";
                  echo "  <div class='alert alert-secondary'>
                          " . getExamDesc('aptitude3') . "
                        </div>";
                } else {
                  echo "<a class='btn btn-large btn-secondary disabled w-100 mb-1' href='#' >" . getExamName('aptitude3') . " Completed!</a>";
                }
                if ($user->data()->aptitude4 == 0) {
                  echo "<a class='btn btn-primary w-100 mb-1' target='_blank' href='userexam.php?type=aptitude4'>" . getExamName('aptitude4') . "</a>";
                  echo "  <div class='alert alert-secondary'>
                        " . getExamDesc('aptitude4') . "
                      </div>";
                } else {
                  echo "<a class='btn btn-large btn-secondary disabled w-100 mb-1' href='#' >" . getExamName('aptitude4') . " Completed!</a>";
                }
                if ($user->data()->aptitude5 == 0) {
                echo "<a class='btn btn-primary w-100 mb-1' target='_blank' href='userexam.php?type=aptitude5'>" . getExamName('aptitude5') . "</a>";
                echo "  <div class='alert alert-secondary'>
                        " . getExamDesc('aptitude5') . "
                      </div>";
                } else {
                  echo "<a class='btn btn-large btn-secondary disabled w-100 mb-1' href='#' >" . getExamName('aptitude5') . " Completed!</a>";
                }
                ?>
            </div>
            <!-- <div class="col-md-5 card1 p-5 shadow-sm">
              <h2 class="text-center m-5"> Take Core Examination</h2>
              <h6 class="text-center mb-3">Exam:<b><?php echo $user->data()->colleges ?></b></h6>
              <?php 
              // if($user->data()->core == 0){
              //  echo "<a class='btn btn-large btn-info w-100 mb-1' href='userexam.php' >Take your COURSE Examination now!</a>";
              // }else{
              //   echo "<a class='btn btn-large btn-secondary disabled w-100 mb-1' href='#' >Course Exam Completed!</a>";
              // }
              ?> -->

            </div>
          </div>
        </div>
       <!-- Modal -->
        <div class="modal" id="examModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Exam Instructions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <small class="text-muted"><p><b>Read Instructions:</b><br />
   <!-- Instructions go here -->
                        <br /> Carefully read any instructions or guidelines provided by the exam administrator. These instructions may vary from one exam to another. <br />
                        <br />
                        <b>Start the Exam:</b>
                        <br />
                        <br /> Click on the button or link to start the exam. The timer will begin counting down from the allocated time limit. <br />
                        <b>Answer Questions:</b>
                        <br />
                        <br /> Proceed to answer the exam questions one by one. <br /> Review each question and provide your answers according to the given instructions. <br />
                        <br />
                        <b>Review Your Answers:</b>
                        <br />
                        <br /> Before submitting the exam, review your answers to ensure you haven't made any mistakes or left any questions unanswered. <br />
                        <br />
                        <b>Submit the Exam:</b>
                        <br />
                        <br /> Once you are confident in your answers and have reviewed the exam, click the "Submit" or "Finish" button to submit your exam. <br /> A confirmation prompt may appear to confirm that you want to submit the exam. Ensure that you want to submit, and then confirm. <br />
                        <br />
                        <b>Confirmation:</b>
                        <br />
                        <br /> You may receive a confirmation message that your exam has been successfully submitted. <br />
                        <br />
                        <b>Post-Exam Instructions:</b>
                        <br />
                        <br /> Pay attention to any post-exam instructions provided, such as how to retrieve your results or any additional steps you need to take.
                      </p>
                      </small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div> 
                </div>
            </div>
        </div>

      </body> 
      <footer class="ft">
        <p class="text-center text-muted">Scores will be emailed directly to your verified email address (<?php echo $user->data()->email ?>)</p>
      </footer>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function () {
        $('#examModal').modal('show');
    });
</script>
</body>
</html>
