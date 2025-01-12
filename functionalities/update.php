<?php
// update_student.php
include('db_connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $email = $_POST['email'];

    $query = "UPDATE students SET name='$name', year='$year', course='$course', email='$email' WHERE id=$id";
    if ($conn->query($query)) {
        header('Location: home.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
