<?php

session_start();

include_once '../services/ReviewService.php';

$name = htmlspecialchars($_POST['name']);
$description = htmlspecialchars($_POST['description']);
$assignedTo = htmlspecialchars($_POST['assignedTo']);

//we first check that the user that is trying to do this is actually an
//administrator
if($_SESSION['user'] == null || strtolower($_SESSION['user']['role']) != 'student'){
    $_SESSION['error'] = 'You are unauthorized to make this operation';
    header('Location: ../index.php');
}else {

    $revisionService = new ReviewService();

    $result = $revisionService->createRevision($name, $description, ' ', $_SESSION['selectedPaper']['id'], $assignedTo);

    if ($result) {
        $_SESSION['success'] = 'created revision successfully';
    } else {
        $_SESSION['error'] = 'could not create revision';
    }
    header('Location: ../student_viewRevisions.php');
}
