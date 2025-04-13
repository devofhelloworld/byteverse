<?php
require 'db1.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_POST['user_id'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $filePath = "";

    if (!empty($_FILES['file']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $filePath = $targetDir . basename($_FILES['file']['name']);

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            die("File upload failed.");
        }
    }

    $stmt = $pdo->prepare("INSERT INTO user_updates (user_id, title, message, file_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $title, $message, $filePath]);

    echo "Upload successful!";
}
?>
<a href="admin_portal.html">Back to Dashboard</a>
