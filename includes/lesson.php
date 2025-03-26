<?php
require_once "../config/connection.php";

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Check if session data exists
if (!isset($_SESSION['login']) || !isset($_SESSION['product_id'])) {
    die("Session data missing. Please log in and select a course.");
}

$login = $_SESSION['login'];
$product_id = $_SESSION['product_id'];

// Calculate course start and end dates
$course_start = new DateTime(date("Y-m-d"));
$course_start->modify("+1 day"); // Start the course the next day
$course_start = $course_start->format('Y-m-d');

$course_end = new DateTime($course_start);
$course_end->modify("+3 months"); // Course duration is 3 months
$course_end = $course_end->format('Y-m-d');

$course_duration = (strtotime($course_end) - strtotime($course_start)) / (60 * 60 * 24); // Duration in days

// Fetch user ID
$query = "SELECT id_kursant FROM kursant WHERE login = '$login';";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    die("User not found.");
}
$row = mysqli_fetch_assoc($result);
$user_id = $row['id_kursant'];

// Fetch course details
$query = "SELECT h_praktyka, h_teoria FROM kurs WHERE id_kurs = '$product_id';";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Course not found.");
}
$row = mysqli_fetch_assoc($result);
$h_te = $row['h_teoria']; // Theory hours
$h_pr = $row['h_praktyka']; // Practice hours
$lesson_count = $h_pr + $h_te; // Total lessons

$lesson_interval = floor($course_duration / $lesson_count); // Interval between lessons

// Function to check if a tutor and car are available at a given time
function isAvailable($conn, $instructor_id, $car_id, $lesson_date, $lesson_time) {
    $query = "SELECT * FROM lekcja 
              WHERE id_instruktor = ? AND id_samochod = ? AND data_odbycia = ? AND godzina = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        die("Failed to prepare statement: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "iiss", $instructor_id, $car_id, $lesson_date, $lesson_time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    return $count == 0; // True if no conflict found
}

// Function to insert lesson into the database
function insertLesson($conn, $user_id, $product_id, $lesson_date, $lesson_time, $lesson_type, $instructor_id, $car_id) {
    $query = "INSERT INTO lekcja (id_kursant, id_instruktor, id_kurs, data_odbycia, godzina, id_samochod, typ_lekcji) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        die("Failed to prepare statement: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "iiissis", $user_id, $instructor_id, $product_id, $lesson_date, $lesson_time, $car_id, $lesson_type);
    if (!mysqli_stmt_execute($stmt)) {
        die("Failed to execute statement: " . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
}

// Fetch available tutors (only those with typ_pracownika = 'instruktor')
$query = "SELECT id_pracownik FROM pracownik WHERE typ_pracownika = 'instruktor';";
$result = mysqli_query($conn, $query);
$instructors = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch available cars (only those with stan = 'dostępny')
$query = "SELECT id_samochod FROM samochod WHERE stan = 'dostępny';";
$result = mysqli_query($conn, $query);
$cars = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (empty($instructors) || empty($cars)) {
    die("No available instructors or cars.");
}

// Default lesson time
$lesson_time = "09:00"; // Default lesson time (can be adjusted)

// Schedule and insert theory lessons
$lesson_date = $course_start;
for ($i = 0; $i < $h_te; $i++) {
    $lesson_date = new DateTime($lesson_date);
    // Skip weekends
    if($lesson_date->format("l") == "Saturday") {
        $lesson_date->modify("+1 day"); // Move to the next Monday
    }
    if($lesson_date->format("l") == "Sunday") {
        $lesson_date->modify("+1 day"); // Move to the next Monday
    }
    $formatted_date = $lesson_date->format("Y-m-d");

    // Assign an available instructor and car
    foreach ($instructors as $instructor) {
        $instructor_id = $instructor['id_pracownik'];
        foreach ($cars as $car) {
            $car_id = $car['id_samochod'];
            // Check if the instructor and car are available
            if (isAvailable($conn, $instructor_id, $car_id, $formatted_date, $lesson_time)) {
                insertLesson($conn, $user_id, $product_id, $formatted_date, $lesson_time, 'teoria', $instructor_id, $car_id);
                break 2; // Exit both loops after scheduling the lesson
            }
        }
    }
    $lesson_date->modify("+$lesson_interval days"); // Move to the next lesson date
    $lesson_date = $lesson_date->format("Y-m-d");
}

// Schedule and insert practice lessons
for ($i = 0; $i < $h_pr; $i++) {
    $lesson_date = new DateTime($lesson_date);
    // Skip weekends
    if($lesson_date->format("l") == "Saturday") {
        $lesson_date->modify("+1 day"); // Move to the next Monday
    }
    if($lesson_date->format("l") == "Sunday") {
        $lesson_date->modify("+1 day"); // Move to the next Monday
    }
    $formatted_date = $lesson_date->format("Y-m-d");

    // Assign an available instructor and car
    foreach ($instructors as $instructor) {
        $instructor_id = $instructor['id_pracownik'];
        foreach ($cars as $car) {
            $car_id = $car['id_samochod'];
            // Check if the instructor and car are available
            if (isAvailable($conn, $instructor_id, $car_id, $formatted_date, $lesson_time)) {
                insertLesson($conn, $user_id, $product_id, $formatted_date, $lesson_time, 'praktyka', $instructor_id, $car_id);
                break 2; // Exit both loops after scheduling the lesson
            }
        }
    }
    $lesson_date->modify("+$lesson_interval days"); // Move to the next lesson date
    $lesson_date = $lesson_date->format("Y-m-d");
}

// echo "Lessons have been successfully scheduled and inserted into the database.";
?>