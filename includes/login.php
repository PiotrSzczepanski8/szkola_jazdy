<?php
    session_start();
    if(isset($_SESSION['typ_pracownika'])){
        header("Location: ../admin/index.php");
        exit();
    }else if(isset($_SESSION['login'])){
        header("Location: ../client/index.php");
        exit();
    }

    require_once("../config/connection.php");
    $logged = false;

    if($_SERVER['REQUEST_METHOD']==="POST"){
        $login = $_POST["login"];
        $password = $_POST["password"];

        $query = "SELECT * FROM pracownik WHERE login='$login' and haslo='$password'";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
            $logged = true;
            $_SESSION['logged'] = $logged;
            $_SESSION['login'] = $login;
            $_SESSION['name'] = $row['imie'];
            $_SESSION['surname'] = $row['nazwisko'];
            $_SESSION['user_type'] = $row['typ_pracownika'];
            header("Location: ../admin/index.php");
            exit();
        }

        $query = "SELECT * FROM kursant WHERE login='$login'and haslo='$password'";
        
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $logged = true;
            $_SESSION['logged'] = $logged;
            $_SESSION['login'] = $login;
            $_SESSION['user_type'] = "kursant";
            header("Location: ../client/index.php");
            exit();
        }else{
            header("Location: ../public/login_failed.php");
            exit();
        }
    }

?>