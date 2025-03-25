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
    <title>Poznaj instruktorów</title>
</head>
<body>
    <?php
            include "../public/components/header.shtml";
            ?>
            <section class="main_secondary">
                <h2 class="uppercase tutors-header">Poznaj naszych instruktorów</h2>
            </section>
            <section class="tutors-container container">
            <?php
                require_once "../config/connection.php";
                $query = "SELECT * from pracownik WHERE typ_pracownika = 'instruktor';";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<div class='tutor-segment'>";
                    echo "<div class='tutor-image'>";
                    echo "<img src='../public/images/".$row['obrazek']."' alt=''>";
                    echo "</div>";
                    echo "<div class='tutor-caption'>";
                    echo "<h3>".$row['imie']." ".$row['nazwisko']."</h3>";
                    echo "<p>".$row['opis']."</p>";
                    echo "</div>";
                    echo "</div>";
                }
            echo "</section>";
            
            include "../public/components/footer.shtml";
        ?>
</body>
</html>