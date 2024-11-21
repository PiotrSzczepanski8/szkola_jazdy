<?php
    session_start();
    if(isset($_SESSION['login'])){
        header("Location: index.php");
    }
    
    require_once("../config/connection.php");

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['p_number'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        $query = "SELECT * FROM kursant WHERE login='$login' or email='$email' or telefon='$phone';";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){

        }else{
            $query = "INSERT INTO kursant(imie, nazwisko, telefon, email, login, haslo) VALUES('$name', '$surname', '$phone', '$email', '$login', '$password');";

            mysqli_query($conn, $query);


            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['logged'] = true;
            
            header("Location: ../client/index.php");
        }
    }
?>