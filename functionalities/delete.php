<?php
// delete_student.php
include('db_connection.php');

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $query = "DELETE FROM students WHERE id = $student_id";
    if ($conn->query($query)) {
        header('Location: home.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
