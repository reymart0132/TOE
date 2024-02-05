<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isUser($user->data()->groups);
$type = $_GET['type'];
$_SESSION['type'] = $type;
$id = $user->data()->id;
$exam = new exam($type);
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
   <script type="text/javascript">
        function checkUnansweredQuestions() {
            var unansweredQuestions = [];
            var questions = document.querySelectorAll('input[type="radio"][value="f"]');
            
            questions.forEach(function(question, index) {
                if (question.checked) {
                    unansweredQuestions.push(index + 1);
                }
            });

            var textarea = document.getElementById('unansweredQuestions');
            textarea.value = unansweredQuestions.join(', ');
        }

        window.addEventListener('scroll', function() {
            checkUnansweredQuestions();
        });
    </script>
 
</head> 
<body>
    <?php require_once('menu/studentmenu2.php');?>
    <div style="min-height:15vh;">&nbsp;</div>
    <div class="container-fluid">
        <div class="row border-1">
            <div class="col-10">
                <small class="text-muted">*** Important! Closing / Refreshing the CURRENT Page or Pressing the Back Button will result in the forfeiture of your examination!</small>
            <form action="compute.php" method="POST" id="myForm">
                <div id="questions">    
                    <?php
                    $exam->viewQuestions();
                    $_SESSION['x'] = $exam->returnX();
                    $_SESSION['answer']= $exam->returnAnswer();
                    $_SESSION['qid']= $exam->returnQid();
                    ?>
                    </div>
                    
                    <input type="checkbox" id="agree" name="agree">
                    <label for="agree" class="text-danger">I have answered and reviewed all the question before submitting this form</label><br>
                    <br><input class="btn btn-danger btn-lg ml-3 col-12" type="submit" value="Submit the exam"/>
                </form>
            </div>
            <div class="col-2">
                <div class="form-group reviewer" >
 
                </div>
                  
            </div>
        </div>
        <div class="card cardT" style="width: 18rem;">
                        <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                        <div class="card-body">
                            <h3>Reviewer</h3>
                            <h5 class="card-title">Question Number that you have not yet answered</h5>
                            <textarea class='form-control'id="unansweredQuestions" readonly></textarea>
                            <p class="card-text"><small class="text-muted" styles="font:80%;"> *Moving the scroll bar will also trigger the reviewer.</small></p>
                            <button href="#" class="btn btn-primary" onclick="checkUnansweredQuestions()">Check Unanswered Questions</button>
                        </div>
                   </div>
    </div>
      
      </body> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
function fullScreen(theURL) {
window.open(theURL, '', 'fullscreen=yes, scrollbars=yes,location=yes,resizable=yes');
}
</script>
    <script>
        // JavaScript code to handle form submission with checkbox validation
        document.getElementById("myForm").addEventListener("submit", function(event) {
            var checkbox = document.getElementById("agree");

            if (!checkbox.checked) {
                alert("You must agree to the terms and conditions before submitting.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
<script>
  document.addEventListener("contextmenu", function (e) {
        e.preventDefault();
        alert('right click disabled!');
    }, false);
</script>

  <script>
        // Set the timer duration in milliseconds (e.g., 300000ms for 5 minutes)
        const duration = <?php echo getExamDuration($type);?>;
        const timerDuration = duration * 60000;
        let timeLeft = timerDuration;

        // Function to update the timer display
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60000); // Convert milliseconds to minutes
            const seconds = Math.floor((timeLeft % 60000) / 1000); // Convert remaining milliseconds to seconds
            document.getElementById("minutes").textContent = minutes;
            document.getElementById("seconds").textContent = seconds < 10 ? `0${seconds}` : seconds;
        }

        // Function to submit the form
        function submitForm() {
            document.getElementById("myForm").submit();
        }

        // Set a timer to update and submit the form when the timer expires
        const timer = setInterval(function () {
            timeLeft -= 1000; // Decrease timeLeft by 1 second (1000 milliseconds)
            updateTimer();

            if (timeLeft <= 0) {
                clearInterval(timer); // Stop the timer
                submitForm(); // Submit the form when the timer expires
            }
        }, 1000); // Update every 1 second
    </script>
  <script>
        // Listen for keydown events
        window.addEventListener('keydown', function (event) {
            // Check if the key combination is Ctrl+F5 (or Command+R on Mac)
            if ((event.ctrlKey || event.metaKey) || event.keyCode === 116 ||event.keyCode === 18 ||event.keyCode === 9 || event.keyCode === 27 ){
                event.preventDefault(); // Prevent the default action (refresh)
                alert('Refresh and Tabbing is disabled on this page.');
            }
        });
        window.addEventListener('keyup', function (event) {
            // Check if the key combination is Ctrl+F5 (or Command+R on Mac)
            if ((event.ctrlKey || event.metaKey) || event.keyCode === 116 ||event.keyCode === 18 ||event.keyCode === 9 || event.keyCode === 27) {
                event.preventDefault(); // Prevent the default action (refresh)
                alert('Refresh is disabled on this page.');
            }
        });
    </script>
    
   
</body>
</html>
