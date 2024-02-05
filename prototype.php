<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
$type ="Automotive Servicing NC I";
$user = new user();
$id = $user->data()->id;
$exam = new exam($type);
?>

<form action="compute.php" method="POST">
<?php
$exam->viewQuestions();
$_SESSION['x'] = $exam->returnX();
$_SESSION['answer']= $exam->returnAnswer();
?>

<br><br><input type="submit" value="Submit"/>
</form>