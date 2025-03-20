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
                
                $query = "SELECT kurs.kategoria, kurs.opis, kurs.id_kurs FROM kurs inner join transakcja on transakcja.id_kurs = kurs.id_kurs inner join kursant on transakcja.id_kursant = kursant.id_kursant WHERE kursant.login like '$login';";
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

                        $id_kurs = $kurs[$i]['id_kurs'];

                        $query = "SELECT lekcja.data_odbycia, lekcja.typ_lekcji, lekcja.godzina, lekcja.id_lekcja FROM lekcja inner join kursant on kursant.id_kursant = lekcja.id_kursant inner join kurs on lekcja.id_kurs = kurs.id_kurs where kursant.login like '$login' and kurs.id_kurs = $id_kurs;";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $ilosc_lekcji = mysqli_num_rows($result);
                        // print_r($row);
                        echo "<ul class='all-lessons'>";
                        for($j = 0; $j < $ilosc_lekcji; $j++){
                            echo "<li>Lekcja ".($j+1).", typ: ".$row[$j]['typ_lekcji'].", data: ".$row[$j]['data_odbycia'].", godzina: ".$row[$j]['godzina']." <a href='move-lesson.php?id=".$row[$j]['id_lekcja']."' class='cool_underline move-lesson'>przenieś lekcję ></a></li>";
                        }
                        echo "</ul>";

                        echo "</details>";
                    }
                ?>
            </section>
        </main>
    </div>
        <?php
            include "../public/components/footer.shtml";
        ?>
</body>
</html>