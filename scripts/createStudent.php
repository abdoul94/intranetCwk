<?php

include '../services/StudentService.php';

session_start();

$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$email = htmlspecialchars($_POST['email']);


if($_SESSION['user'] == null || strtolower($_SESSION['user']['role']) != 'administrator'){
    $_SESSION['error'] = 'You are unauthorized to make this operation';
    header('Location: ../index.php');
}else {


    $result = (new StudentService())->createStudent($firstName, $lastName, $email, $_SESSION['project']['id']);

    if($result){
        $_SESSION['success'] = 'student created successfully';
        header('Location: ../admin_viewProject.php');
        return;
    }else{
        $_SESSION['error'] = 'student could not be created';
        header('Location: ../admin_viewProject.php');
        return;
    }

}