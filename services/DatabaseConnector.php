<?php


//mysql connection string: mysql://vwf78e8t9wern65s:n9e6lrwt2ei3f7r3@wvulqmhjj9tbtc1w.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/k55jqjrga1rdfasa

class DatabaseConnector
{

    public function connect()
    {
//        $con = new mysqli("wvulqmhjj9tbtc1w.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "vwf78e8t9wern65s", "n9e6lrwt2ei3f7r3", "k55jqjrga1rdfasa");
        $con = new mysqli("CSDM-WEBDEV", "1812813", "1812813", "db1812813_cmm007");
        //check connection
        if ($con->connect_error) {
            die("Failed to connect to MySQL: " . $con->connect_error);
        }

//        echo 'Db connection successful';
        return $con;
    }

    public function setupDatabase()
    {
        $con = $this->connect();

        $usersTable = "CREATE TABLE users (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          first_name VARCHAR(30)  ,
          last_name VARCHAR(30)  ,
          email VARCHAR(50) unique,
          password VARCHAR (50)  ,
          role VARCHAR (50)  ,
          token VARCHAR (256) ,
          created_at TIMESTAMP
        )";


        if($con->query($usersTable) === true){
            error_log(print_r("Successfully created users table"));
        }else{
            error_log(print_r("Could not create user table " . $con->error));
        }

        $projectsTable = "CREATE TABLE projects(
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR (50)  , 
          description VARCHAR (900)  ,
          created_at TIMESTAMP 
        )";

        if($con->query($projectsTable) === true){
            error_log(print_r("Successfully created projects table"));
        }else{
            error_log(print_r("Could not create project table" . $con->error));
        }

        $studentProjectTable = "CREATE TABLE student_project(
             id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             user_id int(6)  REFERENCES users(id),
             project_id int(6)  REFERENCES projects(id),
             is_team_lead boolean default false,
             created_at TIMESTAMP 
        )";

        if($con->query($studentProjectTable) === true){
            error_log(print_r("Successfully created student_project table"));
        }else{
            error_log(print_r("Could not create student_project table" . $con->error));
        }

        $papersTable = "CREATE TABLE papers(
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR (50)  , 
          description VARCHAR (900)  ,
          file_url VARCHAR (900) ,
          project_id Int(6)  references projects(id),
          uploaded_by int(6)  references user (id),
          created_at TIMESTAMP 
        )";

        if($con->query($papersTable) == true){
            error_log(print_r("Successfully created paper table"));
        }else{
            error_log(print_r("Could not create paper table" . $con->error));
        }

        $reviewTable = "CREATE TABLE reviews(
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR (50)  , 
          description VARCHAR (900)  ,
          file_url VARCHAR (900) ,
          paper_id Int(6)  references projects(id),
          created_at TIMESTAMP  ,
          assigned_to Int(6) references users(id)
          
        )
        ";

        if($con->query($reviewTable) == true){
            error_log(print_r("Successfully created review table"));
        }else{
            error_log(print_r("Could not create review table" . $con->error));
        }

    }


    public function seedTable(){
        $con = $this->connect();

        $timestamp = date('m/d/Y h:i:s a');

        $administrator = "insert into users (first_name, last_name, email, password, role, created_at) values('Abdoul', 'Onas', 'aonas@scalerilabs.com', 'aonas', 'Administrator', NOW())";

        if($con->query($administrator) == true){
            error_log(print_r("Successfully inserted administrator "));
        }else{
            error_log(print_r("Could not inserted administrator  " . $con->error));
        }
    }


}

?>