<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Read Queries</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        .dashboard h1 { margin-bottom: 20px; color: #333; }
        table { width:100%; border-collapse: collapse; background: #fff; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background: #007bff; color: #fff; }
        table tr:nth-child(even) { background: #f8f9fa; }
        .btn-view { background:#007bff;color:#fff;text-decoration:none;padding:6px 10px;border-radius:4px; }
        .btn-view:hover { background:#0056b3; }
        .query-box {background:#fff;padding:20px;border-radius:6px;box-shadow:0 2px 6px rgba(0,0,0,0.1);}
        .query-details h2 {color:#007bff;margin-bottom:15px;}
        .query-details p {margin-bottom:8px;font-size:15px;}
    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar (Same as dashboard.php) -->
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

                <li><a href="appointment-history.php"><i class="fa fa-calendar"></i> Appointment History</a></li>

                <!-- Contact Queries Dropdown -->
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-envelope"></i> Contact Queries <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="unread-queries.php">Unread Queries</a></li>
                        <li><a href="read-query.php" class="active">Read Queries</a></li>
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

                <li><a href="search.php"><i class="fa fa-search"></i> Patient Search</a></li>
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
            <h1>ADMIN | READ QUERIES</h1>
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM tblcontactus WHERE IsRead IS NOT NULL");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $cnt; ?>.</td>
                            <td><?php echo htmlentities($row['fullname']); ?></td>
                            <td><?php echo htmlentities($row['email']); ?></td>
                            <td><?php echo htmlentities($row['contactno']); ?></td>
                            <td><?php echo htmlentities(substr($row['message'],0,30)).'...'; ?></td>
                            <td><?php echo htmlentities($row['PostingDate']); ?></td>
                            <td>
                                <a href="read-query.php?id=<?php echo $row['id']; ?>" class="btn-view">View</a>
                            </td>
                        </tr>
                    <?php
                        $cnt++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- Query Details Right Side -->
            <?php if(isset($_GET['id'])) { 
                $id = intval($_GET['id']);
                $queryDetails = mysqli_query($con, "SELECT * FROM tblcontactus WHERE id='$id'");
                if($row = mysqli_fetch_array($queryDetails)) {
            ?>
                <div class="query-box query-details" style="margin-top:20px;">
                    <h2>Query Details</h2>
                    <p><strong>Name:</strong> <?php echo htmlentities($row['fullname']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlentities($row['email']); ?></p>
                    <p><strong>Contact No:</strong> <?php echo htmlentities($row['contactno']); ?></p>
                    <p><strong>Message:</strong><br><?php echo htmlentities($row['message']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlentities($row['PostingDate']); ?></p>
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
