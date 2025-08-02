<?php
session_start();
include('include/config.php');

// Ensure user is logged in
if(!isset($_SESSION['login'])) {
    header('Location: user-login.php');
    exit();
}

$msg = '';
if(isset($_POST['submit'])) {
    $specilization = $_POST['Doctorspecialization'];
    $doctorid = $_POST['doctor'];
    $userid = $_SESSION['id'];
    $fees = $_POST['fees'];
    $appdate = $_POST['appdate'];
    $time = $_POST['apptime'];

    $query = mysqli_query($con, "INSERT INTO appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus)
            VALUES('$specilization','$doctorid','$userid','$fees','$appdate','$time',1,1)");

    if($query) {
        $msg = "Your appointment has been booked successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User | Book Appointment</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 90%; max-width: 800px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form label { display: block; margin-top: 10px; }
        form select, form input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        form button { margin-top: 15px; padding: 10px 15px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    function getdoctor(val) {
        $.post("get_doctor.php", {specilizationid: val}, function(data) {
            $("#doctor").html(data);
        });
    }

    function getfee(val) {
        $.post("get_doctor.php", {doctor: val}, function(data) {
            $("#fees").val(data);
        });
    }
    </script>
</head>
<body>
    <div class="header">
        <h2>User | Book Appointment</h2>
    </div>

    <div class="container">
        <?php if($msg) echo '<p class="success">'.$msg.'</p>'; ?>
        <form method="post">
            <label>Doctor Specialization</label>
            <select name="Doctorspecialization" onchange="getdoctor(this.value);" required>
                <option value="">Select Specialization</option>
                <?php
                $ret = mysqli_query($con, "SELECT * FROM doctorspecilization");
                while($row = mysqli_fetch_array($ret)) {
                    echo '<option value="'.$row['specilization'].'">'.$row['specilization'].'</option>';
                }
                ?>
            </select>

            <label>Doctors</label>
            <select name="doctor" id="doctor" onchange="getfee(this.value);" required>
                <option value="">Select Doctor</option>
            </select>

            <label>Consultancy Fees</label>
            <input type="text" name="fees" id="fees" readonly>

            <label>Date</label>
            <input type="date" name="appdate" required>

            <label>Time</label>
            <input type="time" name="apptime" required>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
