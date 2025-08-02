<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

// Delete doctor if requested
if (isset($_GET['del'])) {
    mysqli_query($con, "DELETE FROM doctors WHERE id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "Doctor deleted successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Manage Doctors</title>
    <link rel="stylesheet" href="admin-dashboard.css">
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
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-user-md"></i> Doctors <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="doctor-specialization.php">Doctor Specialization</a></li>
                        <li><a href="add-doctor.php">Add Doctor</a></li>
                        <li><a href="manage-doctors.php" class="active">Manage Doctors</a></li>
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
            <h1>ADMIN | MANAGE DOCTORS</h1>
            <p style="color:green;"><?php echo htmlentities($_SESSION['msg']); $_SESSION['msg'] = ""; ?></p>

            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Specialization</th>
                            <th>Doctor Name</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = mysqli_query($con, "SELECT * FROM doctors");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $cnt; ?>.</td>
                            <td><?php echo htmlentities($row['specilization']); ?></td>
                            <td><?php echo htmlentities($row['doctorName']); ?></td>
                            <td><?php echo htmlentities($row['creationDate']); ?></td>
                            <td>
                                <a href="edit-doctor.php?id=<?php echo $row['id']; ?>" class="btn-edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="manage-doctors.php?id=<?php echo $row['id']; ?>&del=delete"
                                   onClick="return confirm('Are you sure you want to delete?')" class="btn-delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    <?php $cnt++; } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<!-- Dropdown Toggle Script -->
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
