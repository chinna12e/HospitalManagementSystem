<?php
session_start();
include('include/config.php');

// Ensure doctor is logged in
if(!isset($_SESSION['dlogin'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doctor Dashboard - Balaji Clinic Hospital</title>
  <link rel="stylesheet" href="../../style4.css"/>
  <link rel="stylesheet" href="../dashboard.css"/>
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
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <!-- Dashboard Section -->
  <section class="dashboard-section">
    <div class="container">
        <h1 class="dashboard-heading">Welcome, Doctor!</h1>
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
                <h2>Manage Patients</h2>
                <a href="manage-patient.php" class="card-link">Manage Patients</a>
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
