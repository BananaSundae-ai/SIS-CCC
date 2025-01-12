<?php
session_start();
include('includes/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Sanitize inputs
    $username = htmlspecialchars($username, ENT_QUOTES);

    try {
        // Query the database for the admin
        $sql = "SELECT id, username, password FROM admins WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Valid login
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                
                // Close database connections before redirect
                $stmt->close();
                $conn->close();
                
                header("Location: pages/home.php");
                exit();
            }
        }

        // If we get here, login failed
        $stmt->close();
        $conn->close();
        header("Location: index.php?error=Invalid credentials");
        exit();
        
    } catch (Exception $e) {
        // Handle any database errors
        if (isset($stmt)) $stmt->close();
        if (isset($conn)) $conn->close();
        header("Location: index.php?error=Database error");
        exit();
    }
} else {
    // Not a POST request
    header("Location: index.php");
    exit();
}
?>