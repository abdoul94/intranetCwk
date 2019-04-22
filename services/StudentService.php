<?php

include_once 'DatabaseConnector.php';



class StudentService
{

    /**
     *
     * This method is responsible for creating a student.
     *
     * @param $firstName | the first name of the student
     * @param $lastName | the last name of the student
     * @param $email | the email of the student
     * @param $projectId | the id of the project
     *
     * @return boolean
     *
     */
    public function createStudent($firstName, $lastName, $email, $projectId){
        //first we get a database connection

        $con = (new DatabaseConnector())->connect();

        //start transaction
        $con->query('START TRANSACTION');

        $token = md5(uniqid(rand(), true));

        $query = "insert into users  (first_name, last_name, email, password, token, role, created_at) ".
            "values ('".$firstName."', '".$lastName."', '".$email."', '".$lastName."432', '".$token."', 'Student', Now())";

        $result =  $con->query($query);

        $query2 = "insert into student_project (user_id, project_id, created_at) ".
            "values (".$con->insert_id.", ".$projectId.", Now())";
        $result2 = $con->query($query2);


        if($result && $result2){
            $con->query('COMMIT');
            return true;
        }else{
            $con->query('ROLLBACK');
        }

        return false;
    }


    /**
     *
     * This method is responsible for retrieving the data of all students belonging to a project
     *
     * @param $projectId
     *
     */
    public function retrieveAllStudentsForAProject($projectId){
        //first we get a database connection

        $con = (new DatabaseConnector())->connect();

        //get all student_project records for the project

        $query = "select * from student_project where project_id = ".
            trim($projectId);

        $result = $con->query($query);

        $returnedResult = [];
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($returnedResult, $row);
            }
        }

        return $returnedResult;
    }


    /**
     *
     * This method is responsible for retrieving a student by student id
     *
     * @param $studentId
     * @return array|null
     *
     */
    public function retrieveStudentById($studentId){
        //first we get a database conenctioin
        $con = (new DatabaseConnector())->connect();

        //find student

        $query = "select * from users where id = ".trim($studentId);

        $result = $con->query($query);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(strtolower($row['role']) == 'student'){
                return $row;
            }
        }

        return null;
    }


    /**
     *
     * This method is responsible for toggling the 'is_team_leader' status
     * of a student.
     *
     * @param $studentProjectId
     *
     */
    public function toggleStudentTeamLeaderStatus($studentProjectId, $newStatus = false){
        //first we got a database connection
        $con = (new DatabaseConnector())->connect();

        $newStatus = ($newStatus) ? 'true' : 'false';
        $query = "update student_project set is_team_lead = ".
            $newStatus." where id=". trim($studentProjectId);

        $result = $con->query($query);

        return ($result);

    }


    /**
     *
     * This method is responsible for retrieving all student_project
     *
     * @param $studentId
     * @return array
     *
     */
    public function retrieveAllProjectsForAStudent($studentId){
        //first we got a database connection
        $con = (new DatabaseConnector())->connect();

        $query = "select * from student_project where user_id = ".
            trim($studentId);

        $result = $con->query($query);

        $returnedResult = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($returnedResult, $row);
            }
        }

        return $returnedResult;

    }


    public function retrieveAParticularProjectForAStudent($studentId, $projectId){
        //first we got a database connection
        $con = (new DatabaseConnector())->connect();

        $query = "select * from student_project where user_id = ".
            trim($studentId). " and project_id = ". trim($projectId);

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