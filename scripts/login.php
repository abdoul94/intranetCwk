<?php

include '../services/AuthenticationService.php';
session_start();

$authenticateService = new AuthenticationService();

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

$result = $authenticateService->authenticate($email, $password);

//die($email . '  ' . $password);
if($result == null){

    $_SESSION['error'] = 'invalid username or password';
    header("Location: ../index.php");
}else if($result['role'] == 'Administrator'){
    $_SESSION['user'] = $result;
    header("Location: ../admin_dashboard.php");
}
else{
    $_SESSION['user'] = $result;
    header("Location: ../student_dashboard.php");
}


