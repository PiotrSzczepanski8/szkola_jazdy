<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>LimoAuto</title>
</head>
<body>
    <div class="container">
        <?php
            include "../public/components/header.shtml";
            require_once "../config/connection.php";
        ?>
        <main class="store_main">
            <?php
                $query = "SELECT * from kurs;";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<section class='store_section'>";
                    echo "<h1 class='cool_underline'>".$row['kategoria']."</h1>";
                    echo "<p class='description'>".$row['opis']."</p>";
                    echo "<a href='course-preview.php?id=".$row['id_kurs']."'><button>Kup kurs</button></a>";
                    echo "</section>";
                }
            ?>
        </main>
        <?php
            include "../public/components/footer.shtml";
        ?>
    </div>
    <script src="../public/text_cutter.js" defer></script>
</body>
</html>