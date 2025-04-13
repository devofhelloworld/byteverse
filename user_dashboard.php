<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'db1.php';


$stmt = $pdo->query("SELECT * FROM global_announcements ORDER BY created_at DESC LIMIT 5");
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="user_dashboard.css">
</head>
<body>
  <header>
    <h1>Welcome to Your Dashboard</h1>
  </header>

  <nav>
    <a href="#">Home</a>
    <a href="#">Profile</a>
    <a href="#">Settings</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </nav>

  <main>
    <section id="content">
      <h2>Dashboard</h2>
      <p class="intro">Here you'll find updates and files from admin.</p>

      <h3>📰 Announcements</h3>
      <?php if (count($announcements) === 0): ?>
        <p>No announcements at the moment.</p>
      <?php else: ?>
        <ul style="list-style: none; padding-left: 0;">
          <?php foreach ($announcements as $announce): ?>
            <li style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
              <strong><?= htmlspecialchars($announce['title']) ?></strong>
              <br>
              <small><em><?= date('d M Y, h:i A', strtotime($announce['created_at'])) ?></em></small>
              <p><?= nl2br(htmlspecialchars($announce['message'])) ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </section>
  </main>

  <footer>
    &copy; <?= date("Y") ?> Healthy India. All rights reserved.
  </footer>

</body>
</html>
