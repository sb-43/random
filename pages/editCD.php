<?php
session_start();
require '../utils/CD.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}


$cd = new CD();

// Fetch the CD to be edited
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$current_cd = $cd->selectByID($id);

//Time format
$currentSeconds = $current_cd['length'];
$currentMinutes = floor($currentSeconds / 60);
$remainingSeconds = $currentSeconds % 60;


//Check if id is in fact in table, if not it redirects back to index.
if($current_cd){
        
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Check if everything is set
      if(isset($_POST['title'], $_POST['minutes'], $_POST['seconds'], $_POST['author'], $_POST['release_date'])) {
            // Handle form submission for editing the CD
            $title = $_POST['title'];
            $minutes = isset($_POST['minutes']) ? (int)$_POST['minutes'] : 0;
            $seconds = isset($_POST['seconds']) ? (int)$_POST['seconds'] : 0;
            $author = $_POST['author'];
            $release_date = $_POST['release_date'];

            // Calculate total length in seconds
                $length = ($minutes * 60) + $seconds;
                
            // Call the update method from the CD class
            $cd->editCD($id, $title, $length, $author, $release_date);
    
            // Redirect to the home page after updating the CD
            header("Location: dashboard.php");
            exit;
      }
    }
} else {
     // If no ID is provided, redirect back with an error message
     $_SESSION['error'] = "No CD ID provided for editation.";
     header("Location: dashboard.php"); 
     exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit CD - CD Database</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="<?= $_SESSION['theme'] ?? 'blue' ?>">

    <?php require 'navbar.php'; // Navbar included at the top  ?>

    <div class="container container-sm">
        <h1>Edit CD</h1>
        <form id="cd" action="editCD.php?id=<?= $id ?>" method="POST">
            <div id="error-title" class="error-message"></div>
            <input id="title" type="text" name="title" value="<?=$current_cd['title']?>" required>
            <div class="time-inputs">
                <input id="minutes" type="number" name="minutes" value="<?=$currentMinutes?>" min="0" required>
                <div id="error-seconds" class="error-message"></div>
                <input id="seconds" type="number" name="seconds" value="<?=$remainingSeconds?>" min="0" max="59" required>
            </div>
            <div id="error-author" class="error-message"></div>
            <input id="author" type="text" name="author" value="<?=$current_cd['author']?>" required>
            <div id="error-date" class="error-message"></div>
            <input id="release_date" type="date" name="release_date" value="<?=$current_cd['release_date']?>" required>
            <button type="submit" class="btn">Edit CD</button>
        </form>
    </div>

    <!-- Include the external script.js -->
    <script src="../js/script.js"></script>
    <script src="../js/cdFormValidator.js"></script>
</body>

</html>