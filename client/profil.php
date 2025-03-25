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
    <?php
        include "../public/components/font-embed.shtml";
    ?>
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

                $monthOffset = isset($_GET['monthOffset']) ? (int)$_GET['monthOffset'] : 0;
                $today = date("Y-m-01");
                $selectedMonth = date("Y-m-01", strtotime("$today + $monthOffset months"));


                $month_start = $selectedMonth;
                $month_end = date("Y-m-t", strtotime($selectedMonth));

                while (date('w', strtotime($month_start)) != 1) { 
                    $month_start = date('Y-m-d', strtotime('-1 day', strtotime($month_start)));
                }
                while (date('w', strtotime($month_end)) != 0) { 
                    $month_end = date('Y-m-d', strtotime('+1 day', strtotime($month_end)));
                }

                $date_i = $month_start;
                $monthLabel = strftime('%B %Y', strtotime($selectedMonth));
                
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
            <section class='purchased-courses'>
                <?php
                    for($i = 0; $i < $ilosc_kursow; $i++){
                        $id_kurs = $kurs[$i]['id_kurs'];

                        $query = "SELECT lekcja.data_odbycia, lekcja.typ_lekcji, lekcja.godzina, lekcja.id_lekcja FROM lekcja inner join kursant on kursant.id_kursant = lekcja.id_kursant inner join kurs on lekcja.id_kurs = kurs.id_kurs where kursant.login like '$login' and kurs.id_kurs = $id_kurs;";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $ilosc_lekcji = mysqli_num_rows($result);
                        $month_start = date("Y-m-01", strtotime($selectedMonth));
                        $month_end = date("Y-m-t", strtotime($selectedMonth));

                        while (date('w', strtotime($month_start)) != 1) { 
                            $month_start = date('Y-m-d', strtotime('-1 day', strtotime($month_start)));
                        }

                        while (date('w', strtotime($month_end)) != 0) { 
                            $month_end = date('Y-m-d', strtotime('+1 day', strtotime($month_end)));
                        }

                        $date_i = $month_start;
                        setlocale(LC_TIME, 'pl_PL', 'pl', 'Polish_Poland.28592');
                        $month = strftime('%B %Y', strtotime($selectedMonth));

                        echo "<h2>Kurs na prawo jazdy kategorii ".$kurs[$i]['kategoria']."</h2>";
                        echo "<div class='calendar-container'>";
                        echo "<div class='calendar'>";
                        echo "<div class='calendar-header'>";
                        echo "<a href='profil.php?monthOffset=" . ($monthOffset - 1) . "' class='prev-month'>&#x25C0;</a>";
                        echo "<span class='month-name'>" . ucfirst($monthLabel) . "</span>";
                        echo "<a href='profil.php?monthOffset=" . ($monthOffset + 1) . "' class='next-month'>&#x25B6;</a>";
                        echo "</div>";
                        $month = date('F Y', strtotime($selectedMonth));
                        while($date_i <= $month_end){
                            $date_class = "day";
                            $day_data = "";
                            
                            foreach($row as $lesson) {
                                if ($lesson['data_odbycia'] == $date_i) {
                                    $date_class .= " has-lesson";
                                    $day_data = json_encode($lesson);
                                    break;
                                }
                            }
                            
                            foreach($row as $lesson) {
                                if ($lesson['data_odbycia'] == $date_i) {
                                    $date_class .= " lesson-day";
                                    $day_data = json_encode($lesson);
                                    break;
                                }
                            }
                            
                            if (date('Y-m', strtotime($date_i)) !== date('Y-m', strtotime($selectedMonth))) {
                                $date_class .= " unactivable";
                            }
                            
                            echo "<p class='$date_class' data-date='$date_i' data-lesson='" . htmlspecialchars($day_data, ENT_QUOTES, 'UTF-8') . "'>";
                            echo date("d", strtotime($date_i)) . "</p>";
                            
                            $date_i = date('Y-m-d', strtotime('+1 day', strtotime($date_i)));
                        }
                        
                        echo"</div>";
                        echo "<div class='day-info'></div>";
                        echo"</div>";
                    }
                    ?>
            </section>
        </main>
    </div>
        <?php
            include "../public/components/footer.shtml";
        ?>
        <script>
document.addEventListener("DOMContentLoaded", function() {
    let days = document.querySelectorAll(".day");
    let today = new Date().toISOString().split('T')[0];
    let defaultDay = null;

    days.forEach(day => {
        if (day.dataset.date === today) {
            defaultDay = day;
        }
    });

    let firstDayInCalendar = days[7].dataset.date;

    let firstDayOfMonth = new Date(firstDayInCalendar);
    firstDayOfMonth.setDate(1);
    firstDayOfMonth = firstDayOfMonth.toISOString().split('T')[0];

    if (!defaultDay) {
        days.forEach(day => {
            if (day.dataset.date === firstDayOfMonth) {
                defaultDay = day;
            }
        });
    }

    if (defaultDay) {
        selectDay(defaultDay);
    }

    days.forEach(day => {
        day.addEventListener("click", function() {
            if (this.classList.contains("unactivable")) return;

            selectDay(this);
        });
    });

    function selectDay(selectedDay) {
        document.querySelectorAll(".day").forEach(d => d.classList.remove("active"));

        selectedDay.classList.add("active");

        let lessonData = selectedDay.dataset.lesson ? JSON.parse(selectedDay.dataset.lesson) : null;
        let dayInfo = document.querySelector(".day-info");

        if (lessonData) {
            dayInfo.innerHTML = `
                <p>${lessonData.data_odbycia}</p>
                <p><strong>Typ lekcji:</strong> ${lessonData.typ_lekcji}</p>
                <p><strong>Data:</strong> ${lessonData.data_odbycia}</p>
                <p><strong>Godzina:</strong> ${lessonData.godzina}</p>
                <a href='move-lesson.php?id=${lessonData.id_lekcja}' class='cool_underline move-lesson'>Przenieś lekcję ></a>
            `;
        } else {
            dayInfo.innerHTML = `<p>Nie masz zaplanowanych lekcji w tym dniu.</p>`;
        }
    }
});

</script>
</body>
</html>