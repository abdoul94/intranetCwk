<?php

session_start();

include '../services/StudentService.php';

$studentProjectId = htmlspecialchars($_GET['id']);
$status = htmlspecialchars($_GET['status']);

if($_SESSION['user'] == null || strtolower($_SESSION['user']['role']) != 'administrator'){
    $_SESSION['error'] = 'You are unauthorized to make this operation';
    header('Location: ../index.php');
}else {
    $newStatus = ($status == '1') ? true : false;

    $studentService = new StudentService();
    $result = $studentService->toggleStudentTeamLeaderStatus($studentProjectId, $newStatus);

    if($result){
        $_SESSION['success'] = 'Successfully set';
        header('Location: ../admin_viewProject.php');
    }else{
        $_SESSION['error'] = 'Could not perform update';
        header('Location: ../admin_viewProject.php');
    }

}
