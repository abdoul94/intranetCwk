<?php

include_once 'DatabaseConnector.php';

class ReviewService
{

    public function createRevision($name, $description, $fileUrl, $paperId, $assignedTo){
        //get database connection
        $con = (new DatabaseConnector())->connect();

        $query = "insert into reviews (name, description, file_url, paper_id, assigned_to, created_at) ".
            "values('".$name."', '".$description."', '".$fileUrl."', '".$paperId."', '".$assignedTo."', Now())";

        $result = $con->query($query);

        return $result;
    }

    public function setUploadedRevision($revisionId, $fileUrl){
        //get database connection
        $con = (new DatabaseConnector())->connect();

        $query = "update reviews set file_url = '". $fileUrl . "'".
            " where id = ". $revisionId;

        $result = $con->query($query);

        return $result;
    }


    public function retrieveAllRevisionsForAPaper($paperId){
        //get database connection
        $con = (new DatabaseConnector())->connect();

        $query = "select * from reviews where paper_id = ".
            $paperId;

        $result = $con->query($query);

        $returnedResult = [];

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($returnedResult, $row);
            }
        }

        return $returnedResult;
    }

    public function retrieveAllReviewsAssignedToAUser($userId){
        $con = (new DatabaseConnector())->connect();

        $query = "select * from reviews where assigned_to = ".
            $userId;

        $result = $con->query($query);

        $returnedResult = [];

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($returnedResult, $row);
            }
        }

        return $returnedResult;
    }


}