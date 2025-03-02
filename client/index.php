<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>LimoAuto</title>
</head>
<body class='main-page'>
    <?php
            include "../public/components/header.shtml";
            ?>
            <div class="slides">
                <div class="slider-background">
                    <h1>Prowadź bezpiecznie, prowadź z <span>LimoAuto!</span></h1>
                    <a href="store.php" class="see-more-button">sprawdź kursy
                        <img src="../public/images/icons/arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="container">
            <hr>
            <section class="main_secondary">
                <h2>Kursy na <span class="cool_underline">każdy rodzaj</span> prawa jazdy w Polsce!</h2>
            </section>
            <section class="products_overview">
            <?php
                require_once "../config/connection.php";
                $query = "SELECT * from kurs;";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<section class='store_section home_preview'>";
                    echo "<h1 class='cool_underline'>".$row['kategoria']."</h1>";
                    echo "<a class='home_preview_a' href='course-preview.php?id=".$row['id_kurs']."'><button>Zobacz</button></a>";
                    echo "</section>";
                }
            ?>
            </section>
            <hr>
            <section class="main_secondary">
                <h2>Poznaj naszych <span class="cool_underline">instruktorów</span></h2>
            </section>
            <section class="products_overview">
            <?php
                require_once "../config/connection.php";
                $query = "SELECT * from pracownik WHERE typ_pracownika = 'instruktor';";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo "<section class='store_section home_preview' style='max-height: 5em;'>";
                    echo "<h1>".$row['imie']."<br>".$row['nazwisko']."</h1>";
                    echo "</section>";
                }
            ?>
            </section>
        <?php
            include "../public/components/footer.shtml";
        ?>
    </div>
    <script src="../public/scroll.js" defer></script>
</body>
</html>

<script>
    const header = document.querySelector("header");
    const body = document.body;

    body.classList.add('transparent-header');

    window.addEventListener("scroll", () => {
        if (window.scrollY > header.offsetTop) {
            body.classList.remove('transparent-header');
        } else {
            body.classList.add('transparent-header');
        }
    })
</script>