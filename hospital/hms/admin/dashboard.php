<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="admin-dashboard.css" />
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>BALAJI CLINIC</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>

                    <!-- Doctors Dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-user-md"></i> Doctors <span class="arrow">&#9662;</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="doctor-specialization.php">Doctor Specialization</a></li>
                            <li><a href="add-doctor.php">Add Doctor</a></li>
                            <li><a href="manage-doctors.php">Manage Doctors</a></li>
                        </ul>
                    </li>

                    <!-- Users Dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-users"></i> Users <span class="arrow">&#9662;</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="manage-users.php">Manage Users</a></li>
                        </ul>
                    </li>

                    <!-- Patients Dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-wheelchair"></i> Patients <span class="arrow">&#9662;</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="manage-patient.php">Manage Patients</a></li>
                        </ul>
                    </li>

                    <li><a href="appointment-history.php"><i class="fa fa-calendar"></i> Appointment History</a></li>

                    <!-- Contactus Queries Dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-envelope"></i> Contactus Queries <span class="arrow">&#9662;</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="unread-queries.php">Unread Queries</a></li>
                            <li><a href="read-query.php">Read Queries</a></li>
                        </ul>
                    </li>

                    <li><a href="doctor-logs.php"><i class="fa fa-stethoscope"></i> Doctor Session Logs</a></li>
                    <li><a href="user-logs.php"><i class="fa fa-id-card"></i> User Session Logs</a></li>

                    <!-- Reports Dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-file"></i> Reports <span class="arrow">&#9662;</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="between-dates-reports">B/w Dates Reports</a></li>
                        </ul>
                    </li>

                    <li><a href="patient-search.php"><i class="fa fa-search"></i> Patient Search</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="admin-info">
                    <span>@BALAJI</span>
                    <i class="fa fa-user"></i> Admin
                </div>
            </header>
            
            <section class="dashboard">
                <h1>ADMIN | DASHBOARD</h1>
                <div class="dashboard-grid">
                    <div class="card">
                        <i class="fa fa-smile-o"></i>
                        <h2>Manage Users</h2>
                        <p><a href="manage-users.php">
                            <?php 
                                $users = mysqli_query($con,"SELECT * FROM users");
                                echo "Total Users : ".mysqli_num_rows($users);
                            ?>
                        </a></p>
                    </div>
                    <div class="card">
                        <i class="fa fa-users"></i>
                        <h2>Manage Doctors</h2>
                        <p><a href="manage-doctors.php">
                            <?php 
                                $doctors = mysqli_query($con,"SELECT * FROM doctors");
                                echo "Total Doctors : ".mysqli_num_rows($doctors);
                            ?>
                        </a></p>
                    </div>
                    <div class="card">
                        <i class="fa fa-calendar"></i>
                        <h2>Appointments</h2>
                        <p><a href="appointment-history.php">
                            <?php 
                                $apps = mysqli_query($con,"SELECT * FROM appointment");
                                echo "Total Appointments : ".mysqli_num_rows($apps);
                            ?>
                        </a></p>
                    </div>
                    <div class="card">
                        <i class="fa fa-user"></i>
                        <h2>Manage Patients</h2>
                        <p><a href="manage-patient.php">
                            <?php 
                                $patients = mysqli_query($con,"SELECT * FROM tblpatient");
                                echo "Total Patients : ".mysqli_num_rows($patients);
                            ?>
                        </a></p>
                    </div>
                    <div class="card">
                        <i class="fa fa-envelope"></i>
                        <h2>New Queries</h2>
                        <p><a href="unread-queries.php">
                            <?php 
                                $queries = mysqli_query($con,"SELECT * FROM tblcontactus WHERE IsRead IS NULL");
                                echo "Total New Queries : ".mysqli_num_rows($queries);
                            ?>
                        </a></p>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Dropdown Script -->
    <script>
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                this.parentElement.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
