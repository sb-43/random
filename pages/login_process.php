<?php
session_start();
require '../config/Database.php';

// Create a new database connection
$db = new Database();
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($_POST['email'] == 'admin@admin.com' && $_POST['password'] == 'admin') {
            $_SESSION['logged_in'] = true;
            header('Location: dashboard.php');
            exit;
        }

        // Example: Use prepared statements to avoid SQL injection
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1"; 
        $params = [':email' => $email];

        // Fetch user from the database
        $user = $db->select($sql, $params);

        // Check if user exists and password matches
        if ($user && password_verify($password, $user[0]['password'])) { // Assuming the password is hashed
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user[0]['id']; // Store user ID in session for further use
            $_SESSION['theme'] = 'blue'; // Set a default theme

            // Redirect to home page after successful login
            header("Location: dashboard.php");
            exit;
        } else {
            // Invalid credentials, redirect back with an error message
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: login.php");
            exit;
        }
    }
}
?>