<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: index.php"); // Change 'login.php' to the actual login page URL
exit();
?>
