<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: index.php");
        exit();
    }
?>
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
        <?php
            include "../public/components/header.shtml";
        ?>
        <main class="profile_main">
            <?php
                require_once("../config/connection.php");
                
                $query = "SELECT * FROM kursant WHERE login like '$login';";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $imie = $row[0]['imie'];
                $nazwisko = $row[0]['nazwisko'];
                $telefon = $row[0]['telefon'];
                $email = $row[0]['email'];
                
                $query = "SELECT kurs.kategoria, kurs.opis FROM kurs inner join transakcja on transakcja.id_kurs = kurs.id_kurs inner join kursant on transakcja.id_kursant = kursant.id_kursant WHERE kursant.login like '$login';";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                $ilosc_kursow = mysqli_num_rows($result);
                $kurs = $row;
            ?>
            <h1 class="cool_underline"><?php echo $imie." ".$nazwisko; ?></h1>
            <section>
                <h2>Twoje dane:</h2>
                <ul>
                    <li>E-mail: <?php echo $email; ?></li>
                    <li>Numer telefonu: <?php echo $telefon; ?></li>
                </ul>
            </section>
            <h1 class="cool_underline">Zakupione kursy:</h1>
            <section>
                <?php
                    for($i = 0; $i < $ilosc_kursow; $i++){
                        echo "<details>";
                        echo '<summary class="cool_underline" style="width: fit-content;">';
                        echo "Kategoria ".$kurs[$i]['kategoria'];
                        echo "</summary>";

                        $query = "SELECT * FROM lekcja inner join kursant on kursant.id_kursant = lekcja.id_kursant where kursant.login like '$login';";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $ilosc_lekcji = mysqli_num_rows($result);
                        echo $ilosc_lekcji;
                        for($j = 0; $j < $ilosc_lekcji; $j++){
                            echo "Lekcja ".($j+1);
                        }

                        echo "</details>";
                    }
                ?>
            </section>
        </main>
        <?php
            include "../public/components/footer.shtml";
        ?>
    </div>
</body>
</html>