<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
$user = new user();
$id = $user->data()->id;
isAdmin($user->data()->groups);

if(!empty($_GET['id'])){
 $resetUser = new resetUser($_GET['id']);
 $resetUser->resetScore1();
 $resetUser->resetScore2();
 $resetUser->resetScore3();
 header('Location:result.php');
}else{
    header('HTTP/1.0 403 Forbidden');
    echo 'You are not allowed to access this page!';
    exit;
}