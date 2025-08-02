<?php
session_start();
include('include/config.php');

// Ensure user is logged in
if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard - Balaji Clinic Hospital</title>
  <link rel="stylesheet" href="../style4.css"/>
  <link rel="stylesheet" href="dashboard.css"/>
</head>
<body>

  <!-- Header Section -->
  <header>
    <div class="logo">
      <h2>BALAJI CLINIC HOSPITAL</h2>
    </div>
    <nav>
      <a href="edit-profile.php">My Profile</a>
      <a href="appointment-history.php">My Appointments</a>
      <a href="book-appointment.php">Book Appointment</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <!-- Dashboard Section -->
  <section class="dashboard-section">
    <div class="container">
        <h1 class="dashboard-heading">Welcome, Patient!</h1>
        <div class="card-container">
            <div class="card profile">
                <h2>My Profile</h2>
                <a href="edit-profile.php" class="card-link">Update Profile</a>
            </div>
            <div class="card appointments">
                <h2>My Appointments</h2>
                <a href="appointment-history.php" class="card-link">View Appointment History</a>
            </div>
            <div class="card book">
                <h2>Book My Appointment</h2>
                <a href="book-appointment.php" class="card-link">Book Appointment</a>
            </div>
        </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 BALAJI CLINIC HOSPITAL. All rights reserved.</p>
  </footer>

</body>
</html>
