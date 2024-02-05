<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
$user = new user();
$id = $user->data()->id;
isAdmin($user->data()->groups);

if(!empty($_GET)){
    $activator = new activator($_GET['id']);
    $activator->activate();
    header('Location:eq.php?status=qa');
}else{
    header('HTTP/1.0 403 Forbidden');
    echo 'You are not allowed to access this page!';
    exit;
}
