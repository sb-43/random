<?php
session_start();
require '../utils/CD.php'; 

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast to integer to prevent SQL injection

    $cd = new CD();

    // Check if the CD exists before attempting to delete it
    $cdExists = $cd->selectByID($id);

    if ($cdExists) {
        // Call the deleteCD method
        $cd->deleteCD($id);

        // Redirect to the index page with a success message
        $_SESSION['message'] = "CD with ID $id has been deleted successfully.";
        header("Location: dashboard.php"); // Redirect to the main page
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // If the CD does not exist, set an error message
        $_SESSION['error'] = "CD with ID $id does not exist.";
        header("Location: dashboard.php"); 
        exit(); 
    }
} else {
    // If no ID is provided, redirect back with an error message
    $_SESSION['error'] = "No CD ID provided for deletion.";
    header("Location: dashboard.php"); 
    exit();
}
?>