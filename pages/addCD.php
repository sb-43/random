<?php
session_start();
require '../utils/CD.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

$cd = new CD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['title'], $_POST['minutes'], $_POST['seconds'], $_POST['author'], $_POST['release_date'])) {

        // Handle form submission
        $title = $_POST['title'];
        $minutes = isset($_POST['minutes']) ? (int)$_POST['minutes'] : 0;
        $seconds = isset($_POST['seconds']) ? (int)$_POST['seconds'] : 0;
        $author = $_POST['author'];
        $release_date = $_POST['release_date'];

        // Calculate total length in seconds
        $length = ($minutes * 60) + $seconds;
        
        // Call the create method from the CD class
        $cd->createCD($title, $length, $author, $release_date);

        // Redirect to the home page after adding the CD
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add CD - CD Database</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="<?= $_SESSION['theme'] ?? 'blue' ?>">
    <?php require 'navbar.php'; // Navbar included at the top  ?>


    <div class="container container-sm">
        <h1>Add CD</h1>
        <form id="cd" action="addCD.php" method="POST">
            <div id="error-title" class="error-message"></div>
            <input id="title" type="text" name="title" placeholder="Title" required>
            <div class="time-inputs">
                <input id="minutes" type="number" name="minutes" placeholder="Minutes" min="0" required>
                <div id="error-seconds" class="error-message"></div>
                <input id="seconds" type="number" name="seconds" placeholder="Seconds" min="0" max="59" required>
            </div>
            <div id="error-author" class="error-message"></div>
            <input id="author" type="text" name="author" placeholder="Author" required>
            <div id="error-date" class="error-message"></div>
            <input id="release_date" type="date" name="release_date" placeholder="Release Date" required>
            <button type="submit" class="btn">Add CD</button>
        </form>
    </div>

    <script src="../js/script.js"></script>
    <script src="../js/cdFormValidator.js"></script>
</body>

</html>