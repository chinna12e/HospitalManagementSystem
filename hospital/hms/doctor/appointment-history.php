<?php
session_start();
include('include/config.php');

// Ensure doctor is logged in
if(!isset($_SESSION['dlogin'])) {
    header('Location: doctor-login.php');
    exit();
}

// Cancel appointment
if(isset($_GET['cancel']) && isset($_GET['id'])) {
    mysqli_query($con, "UPDATE appointment SET doctorStatus='0' WHERE id='".$_GET['id']."'");
    $msg = "Appointment canceled successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor | Appointment History</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 95%; max-width: 1100px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        table th { background: #f4f4f4; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
        a.cancel { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Doctor | Appointment History</h2>
    </div>

    <div class="container">
        <?php if(isset($msg)) echo '<p class="success">'.$msg.'</p>'; ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Specialization</th>
                    <th>Consultancy Fee</th>
                    <th>Appointment Date / Time</th>
                    <th>Appointment Creation Date</th>
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = mysqli_query($con, "SELECT users.fullName AS fname, appointment.*  
                                       FROM appointment 
                                       JOIN users ON users.id = appointment.userId 
                                       WHERE appointment.doctorId = '".$_SESSION['id']."'");
            $cnt = 1;
            while($row = mysqli_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>".$cnt.".</td>";
                echo "<td>".$row['fname']."</td>";
                echo "<td>".$row['doctorSpecialization']."</td>";
                echo "<td>".$row['consultancyFees']."</td>";
                echo "<td>".$row['appointmentDate']." / ".$row['appointmentTime']."</td>";
                echo "<td>".$row['postingDate']."</td>";

                // Status
                $status = ($row['userStatus']==1 && $row['doctorStatus']==1) ? "Active" :
                          (($row['userStatus']==0 && $row['doctorStatus']==1) ? "Cancel by Patient" : 
                          "Cancel by You");
                echo "<td>".$status."</td>";

                // Action
                if($row['userStatus']==1 && $row['doctorStatus']==1) {
                    echo "<td><a class='cancel' href='appointment-history.php?id=".$row['id']."&cancel=1' onclick='return confirm(\"Cancel this appointment?\")'>Cancel</a></td>";
                } else {
                    echo "<td>Canceled</td>";
                }

                echo "</tr>";
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
