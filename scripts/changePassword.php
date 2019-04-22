<?php
include '../services/AuthenticationService.php';
session_start();

$authenticateService = new AuthenticationService();

$userId = htmlspecialchars($_POST['userId']);
$password = htmlspecialchars($_POST['password']);
$passwordConfirmation = htmlspecialchars($_POST['password_confirmation']);

if($password != $passwordConfirmation){
    $_SESSION['error'] = 'password must be the same with confirm password';
    header('Location: ../student_changePassword.php');
}

$result = $authenticateService->changePassword($userId, $password);

//die($email . '  ' . $password);
if($result == false){

    $_SESSION['error'] = 'could not change password';
    header("Location: ../student_changePassword.php");
}
else{
    $_SESSION['success'] = 'Successfully changed the password';
    header("Location: ../student_changePassword.php");
}
