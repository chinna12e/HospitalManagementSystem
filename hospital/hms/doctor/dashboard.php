<?php
session_start();
include('include/config.php');

// Ensure doctor is logged in
if(!isset($_SESSION['dlogin'])) {
    header('Location: doctor-login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor | Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 90%; max-width: 1100px; margin: 30px auto; }
        .card-container { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .card { background: #fff; padding: 30px; text-align: center; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 280px; }
        .card h2 { margin: 10px 0; }
        .card a { display: inline-block; margin-top: 10px; text-decoration: none; color: #007bff; }
        .logout { text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Doctor | Dashboard</h1>
    </div>

    <div class="container">
        <div class="card-container">
            <div class="card">
                <h2>My Profile</h2>
                <a href="edit-profile.php">Update Profile</a>
            </div>
            <div class="card">
                <h2>My Appointments</h2>
                <a href="appointment-history.php">View Appointment History</a>
            </div>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
