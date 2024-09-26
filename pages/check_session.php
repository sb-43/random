<?php
session_start();
$response = ['loggedIn' => isset($_SESSION["logged_in"])];
echo json_encode($response);
?>
