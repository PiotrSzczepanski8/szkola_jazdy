<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>Coś poszło nie tak...</title>
</head>
<body>
    <div class="container">
        <header>
            <section>
                <a href="../client/index.php" class="logotype">
                    LimoAuto
                    <img src="../public/logo.svg" class="logo">
                </a>
            </section>
            <nav>
            </nav>
        </header>
        <main>
            <section class="login_section">
                <?php
                    require_once("../includes/login.php");
                    echo "Nie udało się zalogować:<br> podano błędne dane.";
                    echo "<a href='../client/login.php'><button class='login_submit home_button' style='width:100%; font-size:.9em; margin-top:4%; padding: 3%;'>Powrót do strony logowania</button></a>";
                ?>
            </section>
        </main>
    </div>
</body>
</html>