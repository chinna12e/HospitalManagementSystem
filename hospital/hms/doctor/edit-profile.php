<?php
session_start();
include('include/config.php');

// Ensure doctor is logged in
if(!isset($_SESSION['dlogin'])) {
    header('Location: doctor-login.php');
    exit();
}

// Update doctor details
if(isset($_POST['submit'])) {
    $docspecialization = $_POST['Doctorspecialization'];
    $docname = $_POST['docname'];
    $docaddress = $_POST['clinicaddress'];
    $docfees = $_POST['docfees'];
    $doccontactno = $_POST['doccontact'];

    $sql = mysqli_query($con, "UPDATE doctors SET 
        specilization='$docspecialization',
        doctorName='$docname',
        address='$docaddress',
        docFees='$docfees',
        contactno='$doccontactno'
        WHERE id='".$_SESSION['id']."'");

    $msg = $sql ? "Doctor details updated successfully!" : "Error updating details.";
}

// Fetch doctor data
$result = mysqli_query($con, "SELECT * FROM doctors WHERE docEmail='".$_SESSION['dlogin']."'");
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor | Edit Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 90%; max-width: 800px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form label { display: block; margin-top: 10px; }
        form select, form input, form textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        form button { margin-top: 15px; padding: 10px 15px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Doctor | Edit Profile</h2>
    </div>

    <div class="container">
        <?php if(isset($msg)) echo "<p class='success'>$msg</p>"; ?>

        <h4><?php echo htmlentities($data['doctorName']); ?>'s Profile</h4>
        <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']); ?></p>
        <?php if($data['updationDate']) { ?>
            <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
        <?php } ?>

        <form method="post">
            <label>Doctor Specialization</label>
            <select name="Doctorspecialization" required>
                <option value="<?php echo htmlentities($data['specilization']); ?>">
                    <?php echo htmlentities($data['specilization']); ?>
                </option>
                <?php
                $ret = mysqli_query($con, "SELECT * FROM doctorspecilization");
                while($row = mysqli_fetch_array($ret)) {
                    echo '<option value="'.$row['specilization'].'">'.$row['specilization'].'</option>';
                }
                ?>
            </select>

            <label>Doctor Name</label>
            <input type="text" name="docname" value="<?php echo htmlentities($data['doctorName']); ?>">

            <label>Doctor Clinic Address</label>
            <textarea name="clinicaddress"><?php echo htmlentities($data['address']); ?></textarea>

            <label>Doctor Consultancy Fees</label>
            <input type="text" name="docfees" value="<?php echo htmlentities($data['docFees']); ?>" required>

            <label>Doctor Contact no</label>
            <input type="text" name="doccontact" value="<?php echo htmlentities($data['contactno']); ?>" required>

            <label>Doctor Email</label>
            <input type="email" value="<?php echo htmlentities($data['docEmail']); ?>" readonly>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
