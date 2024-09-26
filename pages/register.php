<?php
session_start();

if (isset($_SESSION['logged_in'])) {
    header("Location: dashboard.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CD Database</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="<?= $_SESSION['theme'] ?? 'blue' ?>">

    <?php require 'navbar.php'; // Navbar included at the top  ?>

    <div class="container container-sm">
        <h1>Register</h1>

        <!-- Display any registration error message -->
        <?php if (isset($_SESSION['registration_error'])): ?>
        <div class="error-message">
            <?= htmlspecialchars($_SESSION['registration_error']) ?>
            <?php unset($_SESSION['registration_error']); // Clear the message after displaying it ?>
        </div>
        <?php endif; ?>

        <!-- Display success message -->
        <?php if (isset($_SESSION['registration_success'])): ?>
        <div class="success-message">
            <?= htmlspecialchars($_SESSION['registration_success']) ?>
            <?php unset($_SESSION['registration_success']); ?>
        </div>
        <?php endif; ?>

        <form action="registration_process.php" id="register" method="POST">
            <div id="error-email" class="error-message"></div>
            <input id="email" type="email" name="email" placeholder="Email" required>
            <div id="error-password" class="error-message"></div>
            <input title="Password must be at least 8 characters long, contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character." type="password" id="password" name="password" placeholder="Password" required">
            <div id="error-confirm" class="error-message"></div> 
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" class="btn">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <!-- Include the external script.js -->
    <script src="../js/script.js"></script>
    <script src="../js/registerFormValidator.js"></script>
</body>

</html>