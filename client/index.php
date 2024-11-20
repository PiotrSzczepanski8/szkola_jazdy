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
            <hr>
            <section class="main_secondary">
                <h2>Kursy na <span class="cool_underline">każdy rodzaj</span> prawa jazdy w Polsce!</h2>
            </section>
            <section class="products_overview">
            <?php
                require_once "../config/connection.php";
                $query = "SELECT * from kurs;";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<section class='store_section home_preview'>";
                    echo "<h1 class='cool_underline'>".$row['kategoria']."</h1>";
                    echo "<a class='home_preview_a' href='purchase.php?id=".$row['id_kurs']."'><button>Zobacz</button></a>";
                    echo "</section>";
                }
            ?>
            </section>
            <hr>
            <section class="main_secondary">
                <h2>Poznaj naszych <span class="cool_underline">instruktorów</span></h2>
            </section>
            <section class="products_overview">
            <?php
                require_once "../config/connection.php";
                $query = "SELECT * from pracownik WHERE typ_pracownika = 'instruktor';";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<section class='store_section home_preview' style='max-height: 5em;'>";
                    echo "<h1>".$row['imie']."<br>".$row['nazwisko']."</h1>";
                    echo "</section>";
                }
            ?>
            </section>
        </main>
        <footer>
            <a href="index.php" class="logotype">
                &copy; 2024 LimoAuto
                <img src="../public/logo.svg" class="logo">
            </a>
        </footer>
    </div>
    <script src="../public/scroll.js" defer></script>
</body>
</html>