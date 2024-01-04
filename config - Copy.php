<?php
// Connect to the database (replace 'your_database_name', 'your_username', 'your_password' with your actual database information)
$host = "localhost";
$username = "root";
$password = "";
$database = "admin";

$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>