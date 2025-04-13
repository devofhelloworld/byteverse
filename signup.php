<?php
require 'db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Insert user data into database
$sql = "INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $email, $phone, $password);

if ($stmt->execute()) {
    // Redirect to sign-in page after successful registration
    header("Location: sign_in.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
