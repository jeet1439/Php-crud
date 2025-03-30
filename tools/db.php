<?php 
function getDatabaseConnection(){
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $database = "practice_db";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);
    if($connection->connect_error){
        die("Error, Failed connect to mysql:". $connection->connect_error);
    }
    return $connection;
}
?>