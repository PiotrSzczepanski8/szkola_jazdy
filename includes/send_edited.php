<?php
require_once "../config/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    $id_field = $_POST['id_field'];
    $id_value = $_POST['id_value'];

    // Budowanie dynamicznego zapytania
    $updateFields = [];
    foreach ($_POST as $key => $value) {
        if (!in_array($key, ['table', 'id_field', 'id_value']) && !empty($value)) {
            $escapedValue = mysqli_real_escape_string($conn, $value);
            $updateFields[] = "$key = '$escapedValue'";
        }
    }

    // Sprawdzenie, czy są pola do aktualizacji
    if (!empty($updateFields)) {
        $query = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE $id_field = $id_value";
        
        if (mysqli_query($conn, $query)) {
            header("Location: ../admin/index.php");
        } else {
            echo "Błąd aktualizacji: " . mysqli_error($conn);
        }
    } else {
        echo "Brak danych do aktualizacji.";
    }
} else {
    header("Location: index.php");
}
?>
