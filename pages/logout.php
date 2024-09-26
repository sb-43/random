<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
session_destroy();
$_SESSION['logged_out'] = true;
header('Location: dashboard.php');

?>

<script>showSnackbar()</script>
