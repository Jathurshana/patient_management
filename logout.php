<!-- logout.php -->
<?php
    // Start the session
    session_start();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other appropriate location
    header("Location: login.php");
    exit();
?>
