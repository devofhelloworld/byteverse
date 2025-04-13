<!DOCTYPE html>
<html>
<head>
  <title>Sign In</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <h2>Sign In</h2>
  <form action="signin.php" method="POST">
    <input type="text" name="username" placeholder="Username" required /><br />
    <input type="password" name="password" placeholder="Password" required /><br />
    <button type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="sign_up.html">Sign up</a></p>

  <?php
  if (isset($_GET['error']) && $_GET['error'] == "invalid") {
    echo "<p style='color: red;'>Invalid username or password!</p>";
  }
  ?>
</body>
</html>
