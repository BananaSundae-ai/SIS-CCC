<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['id'])) {
    header('Location: pages/home.php');
    exit;
}

// Retrieve error message, if any
$error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | College Registrar -CCC</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Helvetica&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <!-- Error Message -->
            <?php if ($error_message): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Logo -->
            <div class="logo text-center">
                <img src="assets/img/logo.png" alt="CCC - College Registrar" class="mb-3">
            </div>
            
            <!-- Login Form -->
            <h1 class="main-title">CCC - COLLEGE REGISTRAR</h1>
            <h2 class="sub-title">Student Information System</h2>
            <h5 class="form-title">SIGN IN</h5>
            
            <form action="login.php" method="POST" novalidate>
                <div class="mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="keepLoggedIn">
                        <label class="form-check-label text-secondary" for="keepLoggedIn">Keep me logged in</label>
                    </div>
                    <a href="#" class="forgot-password text-primary">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log in</button>
            </form>
            
            <!-- Request Access -->
            <p class="footer-text mt-4">
                Don't have an account? <a href="request_acc.php" class="text-primary text-decoration-none">Request Now</a>
            </p>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
