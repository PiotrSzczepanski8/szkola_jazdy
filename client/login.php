<?php
    if(isset($_SESSION['login'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>Zaloguj się</title>
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
                <a href="register.php" class="line_link">zarejestruj się</a>
                <a href="index.php" class="line_link">strona główna</a>
            </nav>
        </header>
        <main>
            <section class="login_section">
                <h3>Zaloguj się</h3>
                <form class="login_form" action="../includes/login.php" method="post">
                    <label for="login">Podaj login</label>
                    <input type="text" name="login">
                    <label for="password">Podaj hasło</label>
                    <input type="password" name="password">
                    <a href="register.php" class="log_reg">nie mam konta &rightarrow;</a>
                    <input class="login_submit" type="submit" value="Potwierdź">
                </form>
            </section>
        </main>
    </div>
</body>
</html>