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
        <main class="home_page_main">
            <h1>Prowadź bezpiecznie, prowadź z <p>LimoAuto!</p></h1>
            <h4>Pomożemy Ci zdobyć prawo jazdy.</h4>
            <section class="main_section">
                <a href="store.php"><button class="login_submit home_button forward">Wykup kurs</button></a>
                <?php
                    if(!isset($_SESSION['login'])){
                        echo '<a href="login.php"><button class="login_submit home_button forward" id="login_button">Zaloguj się</button></a>';
                    }
                ?>
            </section>
        </main>
    </div>
</body>
</html>