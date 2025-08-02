<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Manage Patients</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        .dashboard h1 { margin-bottom: 20px; color: #333; }
        table { width:100%; border-collapse: collapse; background: #fff; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background: #007bff; color: #fff; }
        table tr:nth-child(even) { background: #f8f9fa; }
        .btn-view, .btn-delete { padding: 6px 10px; border-radius: 4px; text-decoration: none; font-size: 14px; }
        .btn-view { background:#007bff; color:#fff; }
        .btn-view:hover { background:#0056b3; }
        .btn-delete { background:#dc3545; color:#fff; }
        .btn-delete:hover { background:#a71d2a; }
        .details-box {background:#fff;padding:20px;margin-top:20px;border-radius:6px;
                      box-shadow:0 2px 6px rgba(0,0,0,0.1);}
        .details-box h2 {color:#007bff;margin-bottom:15px;}
        .details-box p {margin-bottom:8px;font-size:15px;}
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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-user-md"></i> Doctors <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="doctor-specialization.php">Doctor Specialization</a></li>
                        <li><a href="add-doctor.php">Add Doctor</a></li>
                        <li><a href="manage-doctors.php">Manage Doctors</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-users"></i> Users <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="manage-users.php">Manage Users</a></li>
                    </ul>
                </li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-wheelchair"></i> Patients <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="manage-patient.php" class="active">Manage Patients</a></li>
                    </ul>
                </li>
                <li><a href="appointment-history.php"><i class="fa fa-calendar"></i> Appointment History</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-envelope"></i> Contact Queries <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="unread-queries.php">Unread Queries</a></li>
                        <li><a href="read-query.php">Read Queries</a></li>
                    </ul>
                </li>
                <li><a href="doctor-logs.php"><i class="fa fa-stethoscope"></i> Doctor Session Logs</a></li>
                <li><a href="user-logs.php"><i class="fa fa-id-card"></i> User Session Logs</a></li>
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
            <h1>ADMIN | MANAGE PATIENTS</h1>
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Contact Number</th>
                            <th>Gender</th>
                            <th>Creation Date</th>
                            <th>Updation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = mysqli_query($con, "SELECT * FROM users");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $cnt; ?>.</td>
                            <td><?php echo htmlentities($row['fullName']); ?></td>
                            <td>
                                <?php 
                                echo isset($row['contactno']) && !empty($row['contactno']) 
                                    ? htmlentities($row['contactno']) 
                                    : '<span style="color:red;">Not Provided</span>'; 
                                ?>
                            </td>
                            <td><?php echo isset($row['gender']) ? htmlentities($row['gender']) : 'N/A'; ?></td>
                            <td><?php echo htmlentities($row['regDate']); ?></td>
                            <td><?php echo htmlentities($row['updationDate']); ?></td>
                            <td>
                                <a href="manage-patient.php?id=<?php echo $row['id']; ?>" class="btn-view">View</a>
                                <a href="delete-patient.php?id=<?php echo $row['id']; ?>" class="btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete this patient?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                        $cnt++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- Patient Details -->
            <?php if(isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $sql = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
                if($row = mysqli_fetch_array($sql)) {
            ?>
                <div class="details-box">
                    <h2>Patient Details</h2>
                    <p><strong>Name:</strong> <?php echo htmlentities($row['fullName']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlentities($row['email']); ?></p>
                    <p><strong>Contact No:</strong> 
                        <?php echo isset($row['contactno']) ? htmlentities($row['contactno']) : 'Not Provided'; ?>
                    </p>
                    <p><strong>Gender:</strong> <?php echo isset($row['gender']) ? htmlentities($row['gender']) : 'N/A'; ?></p>
                    <p><strong>Address:</strong> <?php echo isset($row['address']) ? htmlentities($row['address']) : 'N/A'; ?></p>
                    <p><strong>City:</strong> <?php echo isset($row['city']) ? htmlentities($row['city']) : 'N/A'; ?></p>
                    <p><strong>Creation Date:</strong> <?php echo htmlentities($row['regDate']); ?></p>
                    <p><strong>Updation Date:</strong> <?php echo htmlentities($row['updationDate']); ?></p>
                </div>
            <?php } } ?>
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
