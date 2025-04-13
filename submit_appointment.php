<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: sign_in.php");
  exit();
}

$host = "localhost";
$db = "appointment_system";
$user = "root";
$pass = "root"; // Set your MySQL password if needed

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$treatment_for = $_POST['treatment'];
$department = $_POST['department'];
$appointment_date = $_POST['date'];
$appointment_time = $_POST['time'];
$payment_method = $_POST['payment'];
$other_name = isset($_POST['other_name']) ? trim($_POST['other_name']) : null;

// SQL with optional other_name
$sql = "INSERT INTO appointments (
            treatment_for, department, appointment_date, appointment_time, payment_method, other_name
        ) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", 
    $treatment_for, 
    $department, 
    $appointment_date, 
    $appointment_time, 
    $payment_method, 
    $other_name
);

if ($stmt->execute()) {
    // Redirect after successful booking
    header("Location: user_dashboard.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
