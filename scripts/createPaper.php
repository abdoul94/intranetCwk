<?php
session_start();

include '../services/PaperService.php';

$projectId = htmlspecialchars($_POST['projectId']);
$name = htmlspecialchars($_POST['name']);
$description = htmlspecialchars($_POST['description']);

$target_dir = "uploads/";
$target_file = $target_dir . md5(uniqid(rand(), true)) . basename($_FILES["paper"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image


if (!move_uploaded_file($_FILES["paper"]["tmp_name"], $target_file)) {
    $_SESSION['error'] = 'could not upload files successfully';
} else {
    $paperService = new PaperService();


    $result = $paperService->createPaper($projectId, $name, $description, $target_file, $_SESSION['user']['id']);

    if ($result) {
        $_SESSION['success'] = 'successfully created the paper';
    } else {
        $_SESSION['error'] = 'could not create the paper';
    }

}


header('Location: ../student_viewProject.php');