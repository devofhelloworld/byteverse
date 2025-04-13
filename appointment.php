<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: sign_in.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book an Appointment</title>
  <link rel="stylesheet" href="appointment.css" />
</head>
<body>
  <main class="container">
    <h1>Book an Appointment</h1> 

    <form id="appointment-form" action="submit_appointment.php" method="POST" autocomplete="on" novalidate>
      
      
      <div class="form-group">
        <label for="treatment">Who is the treatment for?</label>
        <select id="treatment" name="treatment" required>
          <option value="" disabled selected>Select an option</option>
          <option value="myself">Myself</option>
          <option value="someone">Someone else</option>
        </select>
      </div>
      <div class="form-group" id="other-name-group" style="display: none;">
        <label for="other-name">Name of the person</label>
        <input type="text" id="other-name" name="other_name" placeholder="Enter full name" />
      </div>
      
      

      <div class="form-group">
        <label for="department">Choose a department</label>
        <select id="department" name="department" required>
          <option value="" disabled selected>Select a department</option>
          <option value="heart">Heart Specialist</option>
          <option value="physician">General Physician</option>
          <option value="neurologist">Neurologist</option>
          <option value="skin">Skin Specialist</option>
          <option value="bone">Bone Specialist</option>
          <option value="brain">Brain Specialist</option>
          <option value="eye">Eye Specialist</option>
          <option value="ear">Ear Specialist</option>
          <option value="child">Child Specialist</option>
        </select>
      </div>

      <div class="form-group">
        <label for="date">Preferred appointment date</label>
        <input type="date" id="date" name="date" required />
      </div>

      <div class="form-group">
        <label for="time">Preferred time (24-hour format)</label>
        <input type="time" id="time" name="time" required />
      </div>

      <div class="form-group">
        <label for="payment">Payment Method</label>
        <select id="payment" name="payment" required>
          <option value="" disabled selected>Select a payment method</option>
          <option value="cash">Cash</option>
        </select>
      </div>

      <button type="submit" class="submit-btn">Submit Appointment</button>
    </form>

    <footer>
      <p>&copy; <span id="year"></span> Healthy India. All rights reserved.</p>
    </footer>
  </main>

  <script src="appointment.js" defer></script>
</body>
</html>
