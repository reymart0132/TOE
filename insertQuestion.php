<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
$user = new user();
$id = $user->data()->id;
isAdmin($user->data()->groups);

if(!empty($_POST)){
    $insertQ = new insertQ($_POST['question'], $_POST['choice1'], $_POST['choice2'], $_POST['choice3'], $_POST['choice4'], $_POST['answer'], $_POST['type']);
    $insertQ->insertQuestions();
    header('Location:eq.php?status=q1');
}else{
    header('HTTP/1.0 403 Forbidden');
    echo 'You are not allowed to access this page!';
    exit;
}
