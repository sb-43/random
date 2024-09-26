<?php
session_start();
require '../utils/CD.php';


// Fetch CDs
$cd = new CD();
$allCDs = $cd->selectAll(); // Fetch all CDs for JavaScript to use

// Calculate total pages
$totalCDs = count($allCDs);
$limit = 5;
$totalPages = ceil($totalCDs / $limit);


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD Database</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body class="<?= $_SESSION['theme'] ?? 'blue' ?>">  <!-- Default theme set to 'blue' -->
    
    <?php require 'navbar.php'; // Navbar included at the top  ?>

        
    <div class="container">
        <h1>CD Database</h1>
        <?php if (isset($_SESSION['logged_in'])): ?>
            <a id="addBtn" href="addCD.php" class="btn">Add</a>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Length</th>
                    <th>Author</th>
                    <th>Release Date</th>
                    <?php if (isset($_SESSION['logged_in'])): ?>
                        <th class="actionsHead">Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="cd-table">
                
            </tbody>
        </table>

        <div class="pagination" id="pagination">
           
        </div>

        
    </div>
    <script src="../js/script.js"></script>

    <script>
        const cds = <?= json_encode($allCDs) ?>; // Pass PHP array to JavaScript
        const limit = <?= $limit ?>; // Pass the limit to JavaScript
        let currentPage = 1;

        // Call functions to render initial content
        renderCDs(currentPage);
        renderPagination();
    </script>

<div id="snackbar">Action completed successfully!</div>
<?php if (isset($_SESSION['logged_out'])): print_r($_SESSION['logged_out'])?>
    
    <script>showSnackbar();</script>
<?php endif; ?>
</body>
</html>

