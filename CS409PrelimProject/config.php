<?php
// Database connection configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "users_crownwell_db";

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $password, $database);

// Check if the connection failed
if ($conn->connect_error) {
    // Stop execution and show error if database connection fails
    die("Connection failed: " . $conn->connect_error);
}
?>