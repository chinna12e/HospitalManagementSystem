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
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];

    $sql = mysqli_query($con, "UPDATE users SET fullName='$fname', address='$address', city='$city', gender='$gender' WHERE id='".$_SESSION['id']."'");

    if($sql) {
        $msg = "Your Profile updated Successfully";
    }
}

$result = mysqli_query($con, "SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 90%; max-width: 800px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2, h4 { margin-bottom: 10px; }
        form label { display: block; margin-top: 10px; }
        form input, form textarea, form select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        form button { margin-top: 15px; padding: 10px 15px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
        .success { color: green; text-align: center; font-size: 16px; margin-bottom: 10px; }
        .back { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>User | Edit Profile</h2>
    </div>

    <div class="container">
        <h4><?php echo htmlentities($data['fullName']); ?>'s Profile</h4>
        <p><b>Profile Reg. Date:</b> <?php echo htmlentities($data['regDate']); ?></p>
        <?php if($data['updationDate']) { ?>
            <p><b>Profile Last Updation Date:</b> <?php echo htmlentities($data['updationDate']); ?></p>
        <?php } ?>

        <hr>
        <?php if($msg) echo '<p class="success">'.$msg.'</p>'; ?>

        <form method="post">
            <label>User Name</label>
            <input type="text" name="fname" value="<?php echo htmlentities($data['fullName']); ?>" required>

            <label>Address</label>
            <textarea name="address"><?php echo htmlentities($data['address']); ?></textarea>

            <label>City</label>
            <input type="text" name="city" value="<?php echo htmlentities($data['city']); ?>" required>

            <label>Gender</label>
            <select name="gender" required>
                <option value="<?php echo htmlentities($data['gender']); ?>"><?php echo htmlentities($data['gender']); ?></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label>User Email</label>
            <input type="email" value="<?php echo htmlentities($data['email']); ?>" readonly>
            <a href="change-emaild.php">Update your email id</a>

            <button type="submit" name="submit">Update</button>
        </form>

        <div class="back">
            <a href="dashboard.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
