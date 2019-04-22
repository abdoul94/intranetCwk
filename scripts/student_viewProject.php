<?php

session_start();

include '../services/ProjectService.php';


//this is the procedural logic flow to retrieve  a project.

$id = htmlspecialchars($_GET['id']);

//we first check that the user that is trying to do this is actually an
//administrator
if($_SESSION['user'] == null || strtolower($_SESSION['user']['role']) != 'student'){
    $_SESSION['error'] = 'You are unauthorized to make this operation';
    header('Location: ../index.php');
}else {

    $projectService = new ProjectService();

    $project = $projectService->retrieveProjectById(trim($id));

    if($project == null){
        $_SESSION['error'] = 'Could not find project';

    }else{
        $_SESSION['project'] = $project;
    }

    header('Location: ../student_viewProject.php');
    return;

}