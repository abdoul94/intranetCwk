<?php

include_once 'DatabaseConnector.php';

class PaperService
{

    /**
     *
     * This method is responsible for retrieving  all papers belonging to a project
     *
     * @param $projectId | the project id
     * @return array
     *
     *
     */
    public function getAllPapersInAProject($projectId){

        //get a connection from the database
        $con = (new DatabaseConnector())->connect();

        $query = "select * from papers where project_id=".
            trim($projectId);

        $result = $con->query($query);

        $returnedResult = [];
        if($result->num_rows > 0){
            while($row =$result->fetch_assoc()){
                array_push($returnedResult, $row);
            }
        }

        return $returnedResult;
    }


    /**
     *
     *
     * This method is responsible for creating a paper
     *
     * @param $projectId
     * @param $name
     * @param $description
     * @param $fileUrl
     * @param $userId
     * @return bool|mysqli_result
     *
     */
    public function createPaper($projectId, $name, $description, $fileUrl, $userId){

        //get a connection from the database
        $con = (new DatabaseConnector())->connect();

        $query = "insert into papers (project_id, name, description, file_url, uploaded_by, created_at) values ".
            "('".$projectId."', '".$name."', '".$description."', '".$fileUrl."', '".$userId."', Now())";

        $result = $con->query($query);

        return $result;
    }


    /**
     *
     * This method is responsible for retrieving a paper
     *
     * @param $paperId
     * @return array|null
     */
    public function getPaperById($paperId){

        $con = (new DatabaseConnector())->connect();

        $query = "select * from papers where id = ".
            $paperId;

        $result = $con->query($query);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }

        return null;
    }



}