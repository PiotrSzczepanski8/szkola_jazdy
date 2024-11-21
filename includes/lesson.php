<?php
    require_once "../config/connection.php";

    session_start();

    if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
    }
    
    if(isset($_SESSION['product_id'])){
        $product_id = $_SESSION['product_id'];
    }

    $course_start = new DateTime(date("Y-m-d"));
    $course_start->modify("+1 day");
    $course_start = $course_start->format('Y-m-d');

    $course_end = new DateTime($course_start);
    $course_end->modify("+3 months");
    $course_end = $course_end->format('Y-m-d');

    $course_duration = (strtotime($course_end) - strtotime($course_start)) / (60 * 60 * 24);

    $query = "SELECT * FROM kursant WHERE login = '$login';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $user_id = $row[0]['id_kursant'];

    echo $user_id."<br>";
    echo $product_id."<br>";
    echo $course_start."<br>";
    echo $course_end."<br>";
    echo $course_duration."<br>";

    $query = "SELECT h_praktyka, h_teoria FROM kurs WHERE id_kurs = '$product_id';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $h_te = $row[0]['h_teoria'];
    $h_pr = $row[0]['h_praktyka'];
    $lesson_count = $h_pr + $h_te;

    echo $h_te."<br>";
    echo $h_pr."<br>";
    echo $lesson_count."<br>";
    
    $lesson_interval = floor($course_duration / $lesson_count);

    echo $lesson_interval;

    $lesson_date = $course_start;
    for($i = 0; $i < $h_te; $i++){
        $lesson_date = new DateTime($lesson_date);
        if($lesson_date->format("l") == "Saturday" or $lesson_date->format("l") == "Sunday"){
            $lesson_date->modify("-3 days");
            $lesson_date = $lesson_date->format("Y-m-d, l");
            echo "<br>".($i+1).") ".$lesson_date;
            $lesson_date = new DateTime($lesson_date);
            $lesson_date->modify("+3 days");
            $lesson_date = $lesson_date->format("Y-m-d");
        }else{
            $lesson_date = $lesson_date->format("Y-m-d, l");
            echo "<br>".($i+1).") ".$lesson_date;
        }
        $lesson_date = new DateTime($lesson_date);
        $lesson_date->modify("+$lesson_interval days");
        $lesson_date = $lesson_date->format("Y-m-d");
    }

    for($i = 0; $i < $h_pr; $i++){
        $lesson_date = new DateTime($lesson_date);
        if($lesson_date->format("l") == "Saturday" or $lesson_date->format("l") == "Sunday"){
            $lesson_date->modify("-3 days");
            $lesson_date = $lesson_date->format("Y-m-d, l");
            echo "<br>".($i+1).") ".$lesson_date;
            $lesson_date = new DateTime($lesson_date);
            $lesson_date->modify("+3 days");
            $lesson_date = $lesson_date->format("Y-m-d");
        }else{
            $lesson_date = $lesson_date->format("Y-m-d, l");
            echo "<br>".($i+1).") ".$lesson_date;
        }
        $lesson_date = new DateTime($lesson_date);
        $lesson_date->modify("+$lesson_interval days");
        $lesson_date = $lesson_date->format("Y-m-d");
    }
?>