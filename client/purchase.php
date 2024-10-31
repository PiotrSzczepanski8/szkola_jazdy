<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>LimoAuto</title>
</head>
<body>
    <div class="container">
        <header>
            <section>
                <a href="index.php" class="logotype">
                    LimoAuto
                    <img src="../public/logo.svg" class="logo">
                </a>
            </section> 
            <nav>
                <?php
                    // require("../includes/login.php");
                    require_once "../config/connection.php";
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
            <?php
            if($logged == false){
                echo "<section style='width: 100%; display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center;'>";
                echo "<p style='flex-basis: 100%; text-align: center;'>Zanim kupisz kurs...</p>";
                echo "<section style='display: flex; flex-basis: 25%; gap: 2%;'>";
                echo '<a href="login.php" style="flex-basis:50%;"><button class="login_submit home_button forward">Zaloguj się</button></a>';
                echo '<a href="register.php" style="flex-basis:50%;"><button class="login_submit home_button forward">Zarejestruj się</button></a>';
                echo "</section>";
                echo "</section>";
            }else{
                include_once "../includes/purchase.php";
            }
            ?>
        </main>
    </div>
    <script src="../public/text_cutter.js" defer></script>
</body>
</html>