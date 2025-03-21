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
        <main>
            <section class="home_login" id="home">
                <?php
                    if(isset($_SESSION['user_type'])){
                        $user_type = $_SESSION['user_type'];
                        if($user_type == "admin"){

                            $query = "SHOW TABLES FROM szkola_jazdy;";

                            $result = mysqli_query($conn, $query);
                            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            foreach ($rows as $row => $val){
                                $table = $val['Tables_in_szkola_jazdy'];
                                
                                $query = "SELECT * FROM $table;";
                                
                                $result = mysqli_query($conn, $query);
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                echo "<h3 class='cool_underline'>$table</h3>";

                                echo "<table>";
                                echo "<thead><tr>";
                                if(mysqli_num_rows($result) > 0){
                                    foreach(array_keys($rows[0]) as $header){
                                        echo "<th>$header</th>";
                                    }
                                }else{
                                    echo "w tej tabeli nie ma danych";
                                }
                                echo "</tr></thead>";
                                echo "<tbody>";
                                $i = 1;
                                foreach ($rows as $row => $val){
                                    echo '<tr>';
                                    foreach ($val as $key => $value) {
                                        echo "<td>".$value."</td>";
                                    }
                                    echo "<td class='table_none_border'><button class='login_submit home_button table_button' onClick='editRow(\"$table\", \"$i\")'>Edytuj</button></td>";
                                    echo "<td class='table_none_border'><button class='login_submit home_button table_button' onClick='deleteRow(\"$table\", \"$i\")'>Usuń</button></td>";
                                    echo '</tr>';
                                    $i++;
                                }
                                echo "</tbody>";
                                echo "</table>";
                            }
                        }else if($user_type == "instruktor"){
                            // lekcje z kursantami
                            // wypłaty
                        }
                    }

                ?>
            </section>
        </main>
    </div>
    <script src='../public/delete.js' defer></script>
    <script src='../public/edit.js' defer></script>
</body>
</html>