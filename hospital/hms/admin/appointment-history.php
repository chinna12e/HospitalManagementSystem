<?php
session_start();
include_once('include/config.php');
include_once('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Appointment History</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        .dashboard h1 { margin-bottom: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background: #007bff; color: #fff; }
        table tr:nth-child(even) { background: #f8f9fa; }
    </style>
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
                    <a href="#" class="dropdown-toggle"><i class="fa fa-user-md"></i> Doctors <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="doctor-specialization.php">Doctor Specialization</a></li>
                        <li><a href="add-doctor.php">Add Doctor</a></li>
                        <li><a href="manage-doctors.php">Manage Doctors</a></li>
                    </ul>
                </li>

                <!-- Users Dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-users"></i> Users <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="manage-users.php">Manage Users</a></li>
                    </ul>
                </li>

                <!-- Patients Dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-wheelchair"></i> Patients <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="manage-patient.php">Manage Patients</a></li>
                    </ul>
                </li>

                <li class="active"><a href="appointment-history.php"><i class="fa fa-calendar"></i> Appointment History</a></li>

                <!-- Contact Queries -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-envelope"></i> Contact Queries <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="unread-queries.php">Unread Queries</a></li>
                        <li><a href="read-query.php">Read Queries</a></li>
                    </ul>
                </li>

                <li><a href="doctor-logs.php"><i class="fa fa-stethoscope"></i> Doctor Session Logs</a></li>
                <li><a href="user-logs.php"><i class="fa fa-id-card"></i> User Session Logs</a></li>

                <!-- Reports Dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-file"></i> Reports <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="bwdates-report-ds.php">B/w Dates Reports</a></li>
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
            <h1>ADMIN | APPOINTMENT HISTORY</h1>
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Specialization</th>
                            <th>Consultancy Fee</th>
                            <th>Appointment Date / Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($con, "SELECT users.fullName AS pname, doctors.doctorName AS dname, doctors.specilization AS specialization, appointment.consultancyFees AS fee, appointment.appointmentDate AS appdate, appointment.appointmentTime AS apptime, appointment.userStatus AS ustatus, appointment.doctorStatus AS dstatus 
                        FROM appointment 
                        JOIN users ON users.id=appointment.userId 
                        JOIN doctors ON doctors.id=appointment.doctorId");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?>.</td>
                            <td><?php echo htmlentities($row['pname']); ?></td>
                            <td><?php echo htmlentities($row['dname']); ?></td>
                            <td><?php echo htmlentities($row['specialization']); ?></td>
                            <td><?php echo htmlentities($row['fee']); ?></td>
                            <td><?php echo htmlentities($row['appdate']); ?> / <?php echo htmlentities($row['apptime']); ?></td>
                            <td>
                                <?php 
                                if(($row['ustatus']==1) && ($row['dstatus']==1))  
                                {
                                    echo "Active";
                                }
                                if(($row['ustatus']==0) && ($row['dstatus']==1))  
                                {
                                    echo "Cancelled by Patient";
                                }
                                if(($row['ustatus']==1) && ($row['dstatus']==0))  
                                {
                                    echo "Cancelled by Doctor";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php 
                        $cnt++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

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
