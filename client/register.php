<?php
    session_start();
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
    <title>Zarejestruj się</title>
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
                <a href="login.php" class="line_link">zaloguj się</a>
                <a href="index.php" class="line_link">strona główna</a>
            </nav>
        </header>
        <main>
            <section class="login_section">
                <h3>Zarejestruj się</h3>
                <form class="login_form" method="POST" action="../includes/register.php">
                    <label for="imie">Podaj imie</label>
                    <input type="text" name="name" required>
                    <label for="nazwisko">Podaj nazwisko</label>
                    <input type="text" name="surname" required>
                    <label for="phone">Podaj numer kontaktowy</label>
                    <input type="tel" pattern="\+[0-9]{2,3} [0-9]{3} [0-9]{3} [0-9]{3}" placeholder="+48 000 000 000" name="p_number" required>
                    <label for="email">Podaj email</label>
                    <input type="email" name="email" required>
                    <label for="login">Podaj login</label>
                    <input type="text" name="login" required>
                    <label for="password">Podaj hasło</label>
                    <input type="password" name="password" required>
                    <a href="login.php" class="log_reg">mam już konto &rightarrow;</a>
                    <input class="login_submit" type="submit" value="Potwierdź">
                </form>
            </section>
        </main>
        <?php
            include "../public/components/footer.shtml";
        ?>
    </div>
</body>
</html>