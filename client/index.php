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
                    <img class="scroll-arrow" src="../public/images/icons/arrow-down.svg" alt="">
                </div>
            </div>
            <div class="container offer-header">
                <section class="course_overview">
                <div class="main_secondary">
                    <h2 class="uppercase">Nasze kursy</h2>
                    <p>Oferujemy kursy na wszystkie rodzaje prawa jazdy w Polsce.</p>
                </div>
                </section>
            </div>
                <div class="products_overview">

                    <?php
                require_once "../config/connection.php";
                $query = "SELECT * from kurs limit 3;";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($rows as $row){ 
                    echo '<div class="course-element">';
                    echo '<div class="course-caption">';
                    echo '<h3>Kurs kategorii '.$row['kategoria'].'</h3>';
                    echo '<p>'.$row['opis'].'</p>';
                    echo '<a class="see-more-button" href="">sprawdź'.file_get_contents('../public/images/icons/arrow-right.svg').'</a>';
                    echo '</div>';
                    echo '<div class="course-img">';
                    echo '<img src="../public/images/'.$row['obrazek'].'" alt="">';
                    echo '<div class="course-img-overlay"></div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
        </div>
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
    });

    const button = document.querySelector(".scroll-arrow");

    button.addEventListener("click", scroll);

    const firstSection = document.querySelector('div.slides + div');

    function scroll() {
        window.scrollTo({
            top: firstSection.offsetTop - header.clientHeight,
            left: 0,
            behavior: "smooth",
            duration: 300
        });
    }

    const offer_segments = document.querySelectorAll('.course-element');

    for (let i = 1; i <= offer_segments.length; i++) {

        let button_source = `.course-element:nth-child(${i}) > .course-caption > .see-more-button`;
        let overlay_source = `.course-element:nth-child(${i}) > .course-img > .course-img-overlay`;

        let button = document.querySelector(button_source);
        let overlay = document.querySelector(overlay_source);

        button.addEventListener('mouseenter', () => {
            overlay.style.background = 'linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(157,255,0.7) 100%)';
            overlay.style.opacity = '100%';
        })
        
        button.addEventListener('mouseleave', () => {
            overlay.style.background = 'linear-gradient(180deg, rgba(27,0,117,0.2) 0%, rgba(51,0,219) 100%)';
            overlay.style.opacity = '70%';
        })
    }
</script>