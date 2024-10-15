<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../media/logo.svg" type="image/x-icon">
    <title>Szkoła jazdy</title>
</head>
<body>
    <div class="container">
        <header>
            <section>
                <a href="index.html" class="logotype">
                    Szkoła Jazdy
                    <img src="../../media/logo.svg" class="logo">
                </a>
            </section>
        </header>
        <main>
            <section class="home_login" id="home">
                <h1>Witaj pracowniku! <br> Zaloguj się do systemu:</h1>
                    <a class="login_submit home_button" href="login.html">zaloguj się</a>
            </section>
            <section class="tables">
                <?php
                   $database = "szkola_jazdy";
                   $host = "localhost";
                   $user = "root";
                   $password = "";
                    $connection = new mysqli($host, $user, $password, $database);
                    if ($connection -> connect_errno) {
                        echo "Failed to connect to MySQL: " . $connection -> connect_error;
                        exit();
                    }else{
                        // echo "działa"; 
                    }
                    $result = $connection->query("SELECT * FROM kurs;");
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($rows as $row) {
                        printf("%s (%s)\n", $row["id_kurs"], $row["kategoria"]);
                    }
                    $connection->close();
                ?>   
            </section>
        </main>
    </div>
</body>
</html>