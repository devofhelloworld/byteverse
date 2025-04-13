<?php
require 'db1.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO global_announcements (title, message) VALUES (?, ?)");
    $stmt->execute([$title, $message]);

    echo "Announcement posted!";
}
?>
<a href="admin_portal.html">Back to Dashboard</a>
