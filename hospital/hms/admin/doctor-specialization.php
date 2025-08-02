<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $specilization = $_POST['doctorspecilization'];
    mysqli_query($con, "insert into doctorSpecilization(specilization) values('$specilization')");
    $_SESSION['msg'] = "Doctor Specialization added successfully !!";
}

if (isset($_GET['del'])) {
    mysqli_query($con, "delete from doctorSpecilization where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "data deleted !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Doctor Specialization</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        .dashboard h1 { margin-bottom: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background: #007bff; color: #fff; }
        table tr:nth-child(even) { background: #f8f9fa; }
        .btn-edit, .btn-delete { padding: 6px 10px; border-radius: 4px; text-decoration: none; }
        .btn-edit { background: #007bff; color: #fff; }
        .btn-edit:hover { background: #0056b3; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-delete:hover { background: #a71d2a; }
        form { background: #fff; padding: 15px; border-radius: 6px; max-width: 500px; margin-bottom: 20px; }
        form input { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        form button { background: #007bff; color: #fff; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar (from dashboard.php) -->
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
                        <li><a href="doctor-specilization.php" class="active">Doctor Specialization</a></li>
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
            <h1>ADMIN | MANAGE DOCTOR SPECIALIZATION</h1>
            
            <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != '') { ?>
                <p style="color:green;text-align:center;"><?php echo htmlentities($_SESSION['msg']); ?></p>
            <?php unset($_SESSION['msg']); } ?>

            <!-- Add Specialization Form -->
            <form method="post">
                <input type="text" name="doctorspecilization" placeholder="Enter Doctor Specialization" required>
                <button type="submit" name="submit">Add</button>
            </form>

            <!-- Specialization Table -->
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Specialization</th>
                            <th>Creation Date</th>
                            <th>Updation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = mysqli_query($con, "select * from doctorSpecilization");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?>.</td>
                            <td><?php echo htmlentities($row['specilization']); ?></td>
                            <td><?php echo htmlentities($row['creationDate']); ?></td>
                            <td><?php echo htmlentities($row['updationDate']); ?></td>
                            <td>
                                <a href="edit-doctor-specilization.php?id=<?php echo $row['id'] ?>" class="btn-edit">
                                    Edit
                                </a>
                                <a href="doctor-specilization.php?id=<?php echo $row['id'] ?>&del=delete"
                                   class="btn-delete" 
                                   onclick="return confirm('Do you really want to delete this record?')">
                                    Delete
                                </a>
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
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.classList.toggle('active');
        });
    });
</script>
</body>
</html>
<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $specilization = $_POST['doctorspecilization'];
    mysqli_query($con, "insert into doctorSpecilization(specilization) values('$specilization')");
    $_SESSION['msg'] = "Doctor Specialization added successfully !!";
}

if (isset($_GET['del'])) {
    mysqli_query($con, "delete from doctorSpecilization where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "data deleted !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Doctor Specialization</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        .dashboard h1 { margin-bottom: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background: #007bff; color: #fff; }
        table tr:nth-child(even) { background: #f8f9fa; }
        .btn-edit, .btn-delete { padding: 6px 10px; border-radius: 4px; text-decoration: none; }
        .btn-edit { background: #007bff; color: #fff; }
        .btn-edit:hover { background: #0056b3; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-delete:hover { background: #a71d2a; }
        form { background: #fff; padding: 15px; border-radius: 6px; max-width: 500px; margin-bottom: 20px; }
        form input { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        form button { background: #007bff; color: #fff; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar (from dashboard.php) -->
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
                        <li><a href="doctor-specilization.php" class="active">Doctor Specialization</a></li>
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
            <h1>ADMIN | MANAGE DOCTOR SPECIALIZATION</h1>
            
            <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != '') { ?>
                <p style="color:green;text-align:center;"><?php echo htmlentities($_SESSION['msg']); ?></p>
            <?php unset($_SESSION['msg']); } ?>

            <!-- Add Specialization Form -->
            <form method="post">
                <input type="text" name="doctorspecilization" placeholder="Enter Doctor Specialization" required>
                <button type="submit" name="submit">Add</button>
            </form>

            <!-- Specialization Table -->
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Specialization</th>
                            <th>Creation Date</th>
                            <th>Updation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = mysqli_query($con, "select * from doctorSpecilization");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?>.</td>
                            <td><?php echo htmlentities($row['specilization']); ?></td>
                            <td><?php echo htmlentities($row['creationDate']); ?></td>
                            <td><?php echo htmlentities($row['updationDate']); ?></td>
                            <td>
                                <a href="edit-doctor-specilization.php?id=<?php echo $row['id'] ?>" class="btn-edit">
                                    Edit
                                </a>
                                <a href="doctor-specilization.php?id=<?php echo $row['id'] ?>&del=delete"
                                   class="btn-delete" 
                                   onclick="return confirm('Do you really want to delete this record?')">
                                    Delete
                                </a>
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
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.classList.toggle('active');
        });
    });
</script>
</body>
</html>
