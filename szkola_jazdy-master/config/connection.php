<?php
    function connect_db(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "szkola_jazdy";
        $conn = mysqli_connect($servername, $username, $password, $database);        
        if(!$conn){
            die("connection failed: ".mysqli_connect_error());
        }else{
            return $conn;
        }
    }
    $conn = connect_db();
?>