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
    <title>Przenieś lekcję</title>
</head>
<body>
    <div class="move-lesson-container">

        <?php
        
        include "../public/components/header.shtml";
        require_once "../config/connection.php";
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }

        if

        if(isset($_POST['data']) and $_POST['godzina'] and $_POST['id']){
            $data = $_POST['data'];
            $godzina = $_POST['godzina'];
            $id = $_POST['id'];
            $query = "SELECT * FROM lekcja WHERE godzina = '$godzina' and data_odbycia = '$data';";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if($rows > 0){
                die("masz już lekcję w tym czasie");
            }
            $query = "UPDATE lekcja SET godzina = '$godzina', data_odbycia = '$data' WHERE id_lekcja = $id;";
            mysqli_query($conn, $query);
            header("Location: profil.php");
            exit();
        }
        
        $query = "SELECT * FROM lekcja WHERE id_lekcja = $id;";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        $godzina = $row[0]['godzina'];
        $data = $row[0]['data_odbycia'];
        ?>
        <h1 class="uppercase">Przenieś lekcję</h1>
        <p>Wypełnij formularz, aby przenieść lekcję z <span class="cool_underline"><?php echo $data." o ".$godzina;?></span>.</p>
        <form action="move-lesson.php" class="move-form" method="post">
            <input type="hidden" name="id" value='<?php echo $id;?>'>
            <div>
                <label for="data">Nowa data:</label>
                <input type="date" name="data" value="<?php echo $data;?>" require>
            </div>
            <div>
                <label for="godzina">Nowa godzina:</label>
                <input type="time" name="godzina" value="<?php echo $godzina;?>" require>
            </div>
            <input type="submit" value="Przenieś" class="uppercase purchase-submit">
            </form>
            <?php
            include "../public/components/footer.shtml";
            ?>
</div>
</body>
</html>