<?php
session_start();

// Check if the user is already logged in, redirect to home page if true
if (isset($_SESSION['id'])) {
    header('Location: pages/home.php');
    exit;
}

$error_message = '';
$success_message = '';

// Handle form submission and account creation logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include database connection file
    include('includes/db_connection.php');

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $email = trim($_POST['email']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = 'Passwords do not match!';
    } else {
        // Check if username or email already exists in the database
        $query = "SELECT * FROM admins WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error_message = 'Username or Email is already taken';
        } else {
            // Hash the password before saving
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new admin account into the database
            $insert_query = "INSERT INTO admins (username, password, email) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param('sss', $username, $hashed_password, $email);

            if ($insert_stmt->execute()) {
                $success_message = 'Account successfully created! Please login now.';
            } else {
                $error_message = 'An error occurred, please try again later.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | College Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Helvetica&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1 class="main-title">Create Admin Account</h1>
            <h2 class="sub-title">College Registrar</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($success_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Account Creation Form -->
            <form action="request_acc.php" method="POST">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>

            <p class="footer-text mt-3">
                Already have an account? <a href="index.php" class="text-primary text-decoration-none">Login here</a>
            </p>
        </div>
    </div>

</body>
</html>
