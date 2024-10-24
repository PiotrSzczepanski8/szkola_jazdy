<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>Szkoła jazdy</title>
</head>
<body>
    <div class="container">
        <header>
            <section>
                <a href="index.php" class="logotype">
                    Szkoła Jazdy
                    <img src="../public/logo.svg" class="logo">
                </a>
            </section> 
            <nav>
                <?php
                    require("../includes/login.php");
                    $logged = false;
                    session_start();
                    if(isset($_SESSION['logged'])){
                        $logged = $_SESSION['logged'];
                    }
                    
                    if(isset($_SESSION['login'])){
                        $login = $_SESSION['login'];
                    }

                    if($logged == false){
                        echo "<a href='login.php' class='line_link'>zaloguj się</a>";
                        echo "<a href='register.php' class='line_link'>zarejestruj się</a>";
                    }else{
                        echo $login;
                        echo "<a href='profil.php' class='line_link'>profil</a>";
                        echo "<a href='../public/logout.php' class='line_link logout'>wyloguj</a>";
                    }
                
                ?>
            </nav>
        </header>
        <main>
            <section class="home_login" id="home">
                <h1>Kup kurs już dzisiaj!</h1>
                    <a class="login_submit home_button"  href="register.php">zarejestruj się</a>
                    <a class="login_submit home_button" href="login.php">zaloguj się</a>
            </section>
            <section class="tables">
                
            </section>
        </main>
    </div>
    <script src="../js/open.js"></script>
</body>
</html>