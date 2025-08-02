<?php
session_start();
include("include/config.php");

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $ret = mysqli_query($con, "SELECT * FROM doctors WHERE docEmail='$username' AND password='$password'");
    $num = mysqli_fetch_array($ret);

    if($num > 0) {
        $_SESSION['dlogin'] = $username;
        $_SESSION['id'] = $num['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .container { width: 350px; margin: 100px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .forgot { display: block; text-align: left; font-size: 14px; margin-bottom: 10px; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2> Doctor Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="forgot-password.php" class="forgot">Forgot Password?</a>
            <div class="error"><?php echo $_SESSION['errmsg']; $_SESSION['errmsg'] = ""; ?></div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>
