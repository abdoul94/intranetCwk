<?php
session_start();

include '../services/ProjectService.php';


//this is the procedural logic flow to create  a project.

$name = htmlspecialchars($_POST['name']);
$description = htmlspecialchars($_POST['description']);

//we first check that the user that is trying to do this is actually an
//administrator
if($_SESSION['user'] == null || strtolower($_SESSION['user']['role']) != 'administrator'){
    $_SESSION['error'] = 'You are unauthorized to make this operation';
    header('Location: ../index.php');
}else {

//then we try to create the project

    $projectService = new ProjectService();

    $result = $projectService->createProject($name, $description);

    if ($result) {
        $_SESSION['success'] = 'created project successfully';
    } else {
        $_SESSION['error'] = 'could not create project';
    }

    header('Location: ../admin_dashboard.php');
}
