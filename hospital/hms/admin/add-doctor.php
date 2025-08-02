<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $docspecialization = $_POST['Doctorspecialization'];
    $docname = $_POST['docname'];
    $docaddress = $_POST['clinicaddress'];
    $docfees = $_POST['docfees'];
    $doccontactno = $_POST['doccontact'];
    $docemail = $_POST['docemail'];
    $password = md5($_POST['npass']);
    $sql = mysqli_query($con, "INSERT INTO doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) 
            VALUES('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')");
    if ($sql) {
        $_SESSION['msg'] = "Doctor added successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Add Doctor</title>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <style>
        /* Centered form styling only */
        .dashboard h1 { text-align:center;margin-bottom:20px;color:#333; }
        form {background:#fff;max-width:700px;margin:0 auto;padding:20px;border-radius:6px;
              box-shadow:0 2px 6px rgba(0,0,0,0.1);}
        form label {display:block;margin-bottom:6px;font-weight:600;}
        form input,form select,form textarea {width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:4px;}
        form button {width:100%;background:#007bff;color:#fff;border:none;padding:12px;font-weight:bold;border-radius:4px;font-size:16px;}
        form button:hover {background:#0056b3;}
        p.msg {text-align:center;color:green;margin-bottom:15px;font-weight:600;}
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
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-user-md"></i> Doctors <span class="arrow">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="doctor-specialization.php">Doctor Specialization</a></li>
                        <li><a href="add-doctor.php" class="active">Add Doctor</a></li>
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
            <h1>ADMIN | ADD DOCTOR</h1>
            <?php if($_SESSION['msg']!=""){ ?>
                <p class="msg"><?php echo htmlentities($_SESSION['msg']); $_SESSION['msg']=""; ?></p>
            <?php } ?>
            <form method="post">
                <label>Doctor Specialization</label>
                <select name="Doctorspecialization" required>
                    <option value="">Select Specialization</option>
                    <?php 
                    $ret=mysqli_query($con,"SELECT * FROM doctorSpecilization");
                    while($row=mysqli_fetch_array($ret)) {
                    ?>
                    <option value="<?php echo htmlentities($row['specilization']);?>">
                        <?php echo htmlentities($row['specilization']);?>
                    </option>
                    <?php } ?>
                </select>

                <label>Doctor Name</label>
                <input type="text" name="docname" required>

                <label>Clinic Address</label>
                <textarea name="clinicaddress" required></textarea>

                <label>Consultancy Fees</label>
                <input type="text" name="docfees" required>

                <label>Contact No</label>
                <input type="text" name="doccontact" required>

                <label>Email</label>
                <input type="email" name="docemail" required>

                <label>Password</label>
                <input type="password" name="npass" required>

                <button type="submit" name="submit">Submit</button>
            </form>
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
