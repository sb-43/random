<?php
session_start();
require '../config/Database.php';
// Create a new database connection
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation (server-side)
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['registration_error'] = "All fields are required.";
        header("Location: register.php"); // Redirect back to registration
        exit;
    } elseif ($password !== $confirm_password) {
        $_SESSION['registration_error'] = "Passwords do not match.";
        header("Location: register.php"); // Redirect back to registration
        exit;
    } else {
        // Check if the email is already registered
        $check_sql = "SELECT * FROM users WHERE email = :email LIMIT 1"; 
        $check_params = [':email' => $email];
        $existing_user = $db->select($check_sql, $check_params);

        if ($existing_user) {
            $_SESSION['registration_error'] = "Email is already registered.";
            header("Location: register.php"); // Redirect back to registration
            exit;
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert the new user into the database
            $insert_sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $insert_params = [
                ':email' => $email,
                ':password' => $hashed_password,
            ];

            $db->insert($insert_sql, $insert_params); // Use the insert method from your Database class
            
            $login_sql = "SELECT * FROM users WHERE email = :email LIMIT 1"; 
            $login_params = [':email' => $email];
    
            // Fetch user from the database
            $user = $db->select($login_sql, $login_params);
    
            // Check if user exists and password matches
            if ($user && password_verify($password, $user[0]['password'])) { // Assuming the password is hashed
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user[0]['id']; // Store user ID in session for further use
                $_SESSION['theme'] = 'blue'; // Set a default theme
    
                // Redirect to home page after successful login
                $_SESSION['registration_success'] = "Registration successful. You are now logged in.";
                header("Location: dashboard.php");
                exit;
            } 
        }
    }
} else {
    // Redirect to registration if accessed without POST method
    header("Location: register.php");
    exit;
}
?>
