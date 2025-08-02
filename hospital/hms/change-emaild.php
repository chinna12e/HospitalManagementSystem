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
    $email = $_POST['email'];

    $sql = mysqli_query($con, "UPDATE users SET email='$email' WHERE id='".$_SESSION['id']."'");
    if($sql) {
        $msg = "Your email updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User | Edit Email</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .header { background: #007bff; color: #fff; padding: 15px; text-align: center; }
        .container { width: 90%; max-width: 800px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form label { display: block; margin-top: 10px; }
        form input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        form button { margin-top: 15px; padding: 10px 15px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
        .back { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>User | Edit Profile</h2>
    </div>

    <div class="container">
        <?php if($msg) echo '<p class="success">'.$msg.'</p>'; ?>

        <form method="post">
            <label for="email">User Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="submit">Update</button>
        </form>

        <div class="back">
            <a href="edit-profile.php">← Back to Profile</a>
        </div>
    </div>
</body>
</html>
