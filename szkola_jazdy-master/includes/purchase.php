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
        // echo $kategoria, $cena;
    }else if(!isset($_POST['kurs_id'])){
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
        echo "Zakup zakończony powodzeniem.";
        exit();
    }else{
        echo "coś nie działa... :(";
        exit();
    }
?>

<div class="purchase">
    <h3>
        Kup kurs kategorii
        <?php
            echo $kategoria;
        ?>
    </h3>
    <form action="purchase.php" method="post">
            <p>
                <?php
                    echo $opis;
                ?>
            </p>
            <p class="cool_underline" style="width: fit-content">
                <?php
                    echo "ilość zajęć praktycznych: ".$h_pr."h";
                ?>
            </p>
            <p class="cool_underline" style="width: fit-content">
                <?php
                    echo "ilość zajęć teoretycznych: ".$h_te."h";
                ?>
            </p>
            <p class="cool_underline" style="width: fit-content">
                <?php
                    echo "cena: ".$cena." zł.";
                ?>
            </p>
            <input type="text" name="id_kurs" value="<?php echo $product_id; ?>" style="display: none;">
        <input type="submit" class="login_submit" value="Kup">
    </form>
</div>