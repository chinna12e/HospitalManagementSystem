<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | View Patients</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="custom-dashboard.css"> <!-- custom styles -->
</head>
<body>
<div id="app">
    <?php include('include/sidebar.php'); ?>

    <div class="app-content">
        <?php include('include/header.php'); ?>

        <div class="main-content">
            <div class="wrap-content container" id="container">

                <!-- PAGE TITLE -->
                <section id="page-title" class="text-center mb-4">
                    <h1 class="mainTitle text-primary">Admin | View Patients</h1>
                </section>

                <!-- PATIENT TABLE -->
                <div class="card shadow p-4">
                    <h4 class="mb-3">View <span class="text-bold text-success">Patients</span></h4>
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
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
                        $sql = mysqli_query($con,"SELECT * FROM tblpatient");
                        $cnt = 1;
                        while($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><?php echo $cnt; ?>.</td>
                                <td><?php echo $row['PatientName']; ?></td>
                                <td><?php echo $row['PatientContno']; ?></td>
                                <td><?php echo $row['PatientGender']; ?></td>
                                <td><?php echo $row['CreationDate']; ?></td>
                                <td><?php echo $row['UpdationDate']; ?></td>
                                <td>
                                    <a href="view-patient.php?viewid=<?php echo $row['ID']; ?>" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
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

            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
