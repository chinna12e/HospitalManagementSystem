<?php
session_start();
include('include/config.php');

$msg = '';
if(isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $query = mysqli_query($con, "SELECT id FROM users WHERE fullName='$fullname' AND email='$email'");
    $row = mysqli_fetch_array($query);

    if($row) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        header('Location: reset-password.php');
        exit();
    } else {
        $msg = "Invalid details. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Balaji | Patient Password Recovery</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .success, .error { text-align: center; margin-bottom: 10px; }
        .error { color: red; }
        .login-link { display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Balaji | Patient Password Recovery</h2>
        <?php if($msg) echo '<p class="error">'.$msg.'</p>'; ?>

        <form method="post">
            <label>Registered Full Name</label>
            <input type="text" name="fullname" placeholder="Full Name" required>

            <label>Registered Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <button type="submit" name="submit">Reset</button>
            <div class="login-link">
                Already have an account? <a href="user-login.php">Log-in</a>
            </div>
        </form>
    </div>
</body>
</html>
