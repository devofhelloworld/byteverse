<?php
$host = "localhost";
$db = "sign_up"; // Replace with your database name
$user = "root"; // Replace with your MySQL username
$pass = "root"; // Replace with your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
