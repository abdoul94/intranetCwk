<?php

session_start();

include_once '../services/ReviewService.php';
include_once '../services/PaperService.php';
include_once '../services/StudentService.php';

$paperId = $_GET['id'];

$reviewService = new ReviewService();
$paperService = new PaperService();
$studentService = new StudentService();

if($_SESSION['user'] == null || strtolower($_SESSION['user']['role']) != 'student'){
    $_SESSION['error'] = 'You are unauthorized to make this operation';
    header('Location: ../index.php');
}else {



    $_SESSION['revisions'] = $revisions;
    $_SESSION['selectedPaper'] = $paperService->getPaperById(trim($paperId));

//    var_dump($revisions);

    $students = $studentService->retrieveAllStudentsForAProject($_SESSION['selectedPaper']['project_id']);
    //var_dump($students);
    header('Location: ../student_viewRevisions.php');

}