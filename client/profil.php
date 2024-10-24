<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>Twój profil</title>
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
                    session_start();
                    if(isset($_SESSION['login'])){
                        $login = $_SESSION['login'];
                        echo $login;
                    }
                ?>
                <a href="index.php" class="line_link">strona główna</a>
                <a href="../public/logout.php" class="line_link logout">wyloguj</a>
            </nav>
        </header>
        <main>
            
        </main>
    </div>
</body>
</html>