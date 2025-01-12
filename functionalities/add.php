<?php
// add_student.php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $email = $_POST['email'];

    $query = "INSERT INTO students (name, year, course, email) VALUES ('$name', '$year', '$course', '$email')";
    if ($conn->query($query)) {
        header('Location: home.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
