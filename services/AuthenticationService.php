<?php

include 'DatabaseConnector.php';

class AuthenticationService
{

    public function authenticate($email, $password){
        $databaseConnector = new DatabaseConnector();

        $conn = $databaseConnector->connect();

        $query = "select * from users where email = '". $email . "' and password = '" . $password . "'";

        //die($query);

        $result = $conn->query($query);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            //die($row);
            return $row;
        }else{
            return null;
        }
    }

    public function changePassword($userId, $password){
        $databaseConnector = new DatabaseConnector();

        $conn = $databaseConnector->connect();

        $query = "update users set password = '" . $password . "' where id = ".$userId;

        //die($query);

        $result = $conn->query($query);

       return $result;
    }


}