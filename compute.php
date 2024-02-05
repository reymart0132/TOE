<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
$user = new user();
isUser($user->data()->groups);

if(!empty($_POST)){

}else{
    header('HTTP/1.0 403 Forbidden');
    echo 'You are not allowed to access this page!';
    exit;
}

$id = $user->data()->id;
$name = $user->data()->fname." ". $user->data()->lname." ". $user->data()->mname;
$type = $_SESSION['type'];
$answers = $_SESSION['answer'];
$qid = $_SESSION['qid'];
$userAnswer = array_values($_POST);


$x ='0';
$score = '0';

foreach ($answers as $answer){
    if($answer == $userAnswer["$x"]){
        $correct = new insertCorrect($qid["$x"], $name, $user->data()->id);
        $correct->insertCorrect();
        $score++;
        $x++;
    }else{
        $mistake = new insertMistakes($qid["$x"], $name, $user->data()->id);
        $mistake->insertMistakes();
        $x++;
    }
}
$status ="FAILED";

if($score >= getPassingScore($type)){
    $status = "PASSED";
}else{
    $status ="FAILED";
}
$examChecker = new examChecker($id,$score,$name,$type,$status);
$examChecker->insertScore();
$examChecker->updateUserScore();
$examChecker->editUserExamPermission();
header('Location:userdashboard.php');

echo "Your Score: ".$score;
