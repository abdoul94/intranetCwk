<?php

include_once 'DatabaseConnector.php';

class ProjectService
{

    /**
     *
     * This method handles creating a project
     *
     * @param $name | then name of the project
     * @param $description | the description of the project
     *
     * @return boolean.
     *
     */
    public function createProject($name, $description){
        //first we get a connection from the database

        $con = (new DatabaseConnector())->connect();

        $query = "insert into projects (name, description, created_at) values('".$name."', '".$description."', NOW())";

        return $con->query($query);
    }

    /**
     *
     * This method handles retrieving all projects
     *
     * @return array of projects
     *
     */
    public function retrieveAllProjects(){
        //first we get a connection from the database

        $con = (new DatabaseConnector())->connect();
        $query = "select * from projects order by created_at desc";

        $result = $con->query($query);

        $returnedResult = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($returnedResult, $row);
            }
        }

        return $returnedResult;

    }




    public function retrieveProjectById($id) {
        $con = (new DatabaseConnector())->connect();
        $query = "select * from projects where id=".$id;

        $result = $con->query($query);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }

        return null;

    }



}