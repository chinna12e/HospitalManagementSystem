<?php
session_start();
include('include/config.php');

// Ensure user is logged in
if(!isset($_SESSION['login'])) {
    header('Location: user-login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 90%; max-width: 1100px; margin: 30px auto; }
        .card-container { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        
        .card {
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            color: #fff;
            width: 250px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        
        .profile { background: linear-gradient(135deg, #ff7eb3, #ff758c); }
        .appointments { background: linear-gradient(135deg, #42a5f5, #478ed1); }
        .book { background: linear-gradient(135deg, #66bb6a, #43a047); }
        
        .card h2 { margin: 10px 0; font-size: 20px; }
        .card a { display: inline-block; margin-top: 10px; text-decoration: none; color: #fff; font-weight: bold; }
        
        .logout { text-align: center; margin-top: 30px; }
        .logout a { color: #007bff; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Balaji Clinic - User Dashboard</h1>
    </div>

    <div class="container">
        <div class="card-container">
            <div class="card profile">
                <h2>My Profile</h2>
                <a href="edit-profile.php">Update Profile</a>
            </div>
            <div class="card appointments">
                <h2>My Appointments</h2>
                <a href="appointment-history.php">View Appointment History</a>
            </div>
            <div class="card book">
                <h2>Book My Appointment</h2>
                <a href="book-appointment.php">Book Appointment</a>
            </div>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
