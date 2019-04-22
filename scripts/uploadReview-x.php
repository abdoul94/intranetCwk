<?php

session_start();

include_once '../services/ReviewService.php';

$reviewService = new ReviewService();

$reviewId = htmlspecialchars($_POST['reviewId']);

$target_dir = "uploads/";
$target_file = $target_dir . md5(uniqid(rand(), true)) . basename($_FILES["myReview"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image


if (move_uploaded_file($_FILES["myReview"]["tmp_name"], $target_file)) {

    $result = $reviewService->setUploadedRevision($reviewId, $target_file);

    if ($result) {
        $_SESSION['s_success'.trim($reviewId)] = 'uploaded review successfully';
    } else {
        $_SESSION['e_error'.trim($reviewId)] = 'could not upload review';
    }



}else{
    $_SESSION['e_error'.trim($reviewId)] = 'could not upload review file';
}

header('Location: ../student_assignedReviews.php');