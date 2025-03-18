<?php
    require_once("../config/connection.php");
    // session_start();
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
    }

    if(isset($_GET['id'])){
        $product_id = $_GET['id'];
        $_SESSION['product_id'] = $product_id;
        // echo $product_id;
        $query = "SELECT * FROM kurs WHERE id_kurs=$product_id;";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $kategoria = $row[0]['kategoria'];
        $opis = $row[0]['opis'];
        $cena = $row[0]['cena'];
        $h_pr = $row[0]['h_praktyka'];
        $h_te = $row[0]['h_teoria'];
        $obrazek = $row[0]['obrazek'];
        // echo $kategoria, $cena;
    }else if(!isset($_POST['kurs_id'])){
        if(!isset($_SESSION['login'])){
            header("Location: ../public/login_first.php");
            exit();
        }
        if(isset($_SESSION['product_id'])){
            $product_id = $_SESSION['product_id'];
        }
        $query = "SELECT id_kursant FROM kursant WHERE login='$login';";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $client_id = $row[0]['id_kursant'];
        $curr_date = date("Y-m-d");
        $query = "INSERT INTO transakcja(id_kurs, id_kursant, data_transakcji) VALUES('$product_id', '$client_id', '$curr_date');";
        mysqli_query($conn, $query);

        // do zrobienia: algorytm automatycznego generowania danych lekcji dla kursu zakupionego przez użytkownika

        include("lesson.php");

        echo "Zakup zakończony powodzeniem.";
        exit();
    }else{
        echo "coś nie działa... :(";
        exit();
    }
?>

<div class="purchase">
    <h3 class="uppercase">
        Kurs na prawo jazdy kategorii
        <?php
            echo $kategoria;
        ?>
    </h3>
    <form action="course-preview.php" method="post">
        <div class="purchase-form">
            <div class="course-preview-image">
                <img src="../public/images/<?php echo $obrazek; ?>" alt="">
                <div class="course-img-overlay"></div>
            </div>
            <div class="course-preview-caption">
                <p>
                    <?php
                    echo $opis;
                    ?>
                </p>
                <p class="" style="width: fit-content; display: inline;">
                <?php
                    echo "<strong>Ilość zajęć praktycznych: </strong>".$h_pr."h.";
                    ?>
                </p>
                <p class="" style="width: fit-content; display: inline;">
                <?php
                    echo "<strong>Ilość zajęć teoretycznych: </strong>".$h_te."h.";
                    ?>
                </p>
                <p class="" style="width: fit-content">
                <?php
                    echo "<strong>Cena: </strong>".$cena." zł.";
                    ?>
                </p>
                <input type="text" name="id_kurs" value="<?php echo $product_id; ?>" style="display: none;">
            </div>
        </div>
        <input type="submit" value="Kup" class="purchase-submit">
    </form>
</div>