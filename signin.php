<?php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Check if the password matches
    if (password_verify($password, $user['password'])) {
        // Store session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the appointment page
        header("Location: appointment.php");
        exit();
    } else {
        // Password is incorrect, redirect back with error
        header("Location: sign_in.php?error=invalid");
        exit();
    }
} else {
    // User not found, redirect back with error
    header("Location: sign_in.php?error=invalid");
    exit();
}

$stmt->close();
$conn->close();
?>
