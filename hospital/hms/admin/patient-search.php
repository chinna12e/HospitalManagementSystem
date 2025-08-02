<?php
session_start();
include_once('include/config.php');
include_once('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Patient Search</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        .dashboard h1 { margin-bottom: 20px; color: #333; }
        form input[type="text"] { padding: 8px; width: 250px; }
        form input[type="submit"] { padding: 8px 15px; background: #007bff; color: #fff; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 20px; }
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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-wheelchair"></i> Patients <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="manage-patient.php">Manage Patients</a></li>
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
                        <li><a href="between-dates-reports">B/w Dates Reports</a></li>
                    </ul>
                </li>

                <li class="active"><a href="patient-search.php"><i class="fa fa-search"></i> Patient Search</a></li>
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
            <h1>PATIENT SEARCH</h1>
            <form method="post">
                <input type="text" name="searchdata" placeholder="Enter Patient Name or Contact" required>
                <input type="submit" name="search" value="Search">
            </form>

            <?php
            if(isset($_POST['search'])) {
                $sdata = $_POST['searchdata'];
            ?>
            <h3>Search Results for "<?php echo htmlentities($sdata); ?>"</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Contact Number</th>
                        <th>Gender</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM tblpatient WHERE PatientName LIKE '%$sdata%' OR PatientContno LIKE '%$sdata%'");
                    $num = mysqli_num_rows($query);
                    if($num > 0) {
                        $cnt=1;
                        while($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?>.</td>
                        <td><?php echo htmlentities($row['PatientName']); ?></td>
                        <td><?php echo htmlentities($row['PatientContno']); ?></td>
                        <td><?php echo htmlentities($row['PatientGender']); ?></td>
                        <td><?php echo htmlentities($row['CreationDate']); ?></td>
                        <td>
                            <a href="view-patient.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="btn-view">View</a>
                        </td>
                    </tr>
                    <?php $cnt++; } } else { ?>
                        <tr><td colspan="6" style="color:red;">No record found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
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
