<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>Nasze kursy</title>
</head>
<body>
    <div class="">
        <?php
            include "../public/components/header.shtml";
            require_once "../config/connection.php";
        ?>
        <div class="container offer-header">
                <section class="course_overview">
                <div class="main_secondary">
                    <h2 class="uppercase">Nasze kursy</h2>
                    <p>Oferujemy kursy na wszystkie rodzaje prawa jazdy w Polsce.</p>
                </div>
                </section>
            </div>
        <main class="store_main">
            
            <?php
                $query = "SELECT * from kurs;";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<div class='store_section' style='background-image: url("."../public/images/".$row['obrazek']."')'>";
                    echo "<a href='course-preview.php?id=".$row['id_kurs']."'>";
                    echo "<h1 class=''>".$row['kategoria']."</h1>";
                    echo "<p class='description'>".$row['opis']."</p>";
                    echo "</a>";
                    echo "<div class='course-img-overlay'></div>";
                    echo "</div>";
                }
            ?>
        </main>
    </div>
        <?php
            include "../public/components/footer.shtml";
        ?>
    <script src="../public/text_cutter.js" defer></script>
</body>
</html>