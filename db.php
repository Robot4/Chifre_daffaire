<?php
// Establish a database connection (replace with your database credentials)
session_start(); // Start a session
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ca";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>