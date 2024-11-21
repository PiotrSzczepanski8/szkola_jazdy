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
                    session_start();
                    if(isset($_SESSION['name']) && isset($_SESSION['surname'])){
                        $imie = $_SESSION['name'];
                        $nazwisko = $_SESSION['surname'];
                        echo "<p style='margin: 0; display: flex; align-items: center;'>".$imie." ".$nazwisko."</p>";
                    }
                ?>
                <a href='../public/logout.php' class='line_link logout'>wyloguj</a>
            </nav>
        </header>
        <main>
            <section class="home_login" id="home">
                <?php
                    if(isset($_SESSION['user_type'])){
                        $user_type = $_SESSION['user_type'];
                        if($user_type == "admin"){

                        }else{
                            
                        }
                    }

                ?>
            </section>
            <section class="tables">
                
            </section>
        </main>
    </div>
</body>
</html>