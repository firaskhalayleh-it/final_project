<?php
// Database connection details
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "firas company";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
