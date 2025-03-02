<?php
    require_once "../config/connection.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        exit();
    }
    
    if(isset($_GET['table'])){
        $table = $_GET['table'];
    }else{
        exit();
    }
    $query = "DELETE FROM $table WHERE id_$table = $id;";

    mysqli_query($conn, $query);

    header("Location: ../admin/index.php");
    exit();
?>