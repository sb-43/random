<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CD Database</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="<?= $_SESSION['theme'] ?? 'blue' ?>">
    <?php require 'navbar.php'; // Navbar included at the top  ?>



    <div class="container container-sm">
        <h1>Login</h1>
        <!-- Your login form -->
        <form action="login_process.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>

    <!-- Include the external script.js -->
    <script src="../js/script.js"></script>
</body>

</html>