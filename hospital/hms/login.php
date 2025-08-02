<?php
session_start();
include("include/config.php");

if(isset($_POST['submit'])) {
    $user_type = $_POST['user_type'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if ($user_type === 'patient') {
        $query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
        $redirect_url = "dashboard.php";
        $session_key = 'login';
    } elseif ($user_type === 'doctor') {
        $query = "SELECT * FROM doctors WHERE docEmail='$username' AND password='$password'";
        $redirect_url = "doctor/dashboard.php";
        $session_key = 'dlogin';
    }

    $ret = mysqli_query($con, $query);
    $num = mysqli_fetch_array($ret);

    if($num > 0) {
        $_SESSION[$session_key] = $username;
        $_SESSION['id'] = $num['id'];
        header("Location: $redirect_url");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Balaji Clinic Hospital</title>
  <link rel="stylesheet" href="../style4.css"/>
  <link rel="stylesheet" href="login.css"/>
</head>
<body>

  <!-- Header Section -->
  <header>
    <div class="logo">
      <h2>BALAJI CLINIC HOSPITAL</h2>
    </div>
    <nav>
      <a href="../index.html">Home</a>
      <a href="../services.html">Services</a>
      <a href="../about.html">About Us</a>
      <a href="admin/index.php">Admin Login</a>
    </nav>
  </header>

  <!-- Login Section -->
  <section class="login-section">
    <div class="login-container">
      <h2>Login</h2>
      <form method="post" action="login.php">
        <div class="form-group">
          <label for="user-type">Login as:</label>
          <div class="radio-group">
            <input type="radio" id="patient" name="user_type" value="patient" checked>
            <label for="patient">Patient</label>
            <input type="radio" id="doctor" name="user_type" value="doctor">
            <label for="doctor">Doctor</label>
          </div>
        </div>
        <div class="form-group">
          <input type="text" name="username" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <a href="forgot-password.php" class="forgot">Forgot Password?</a>
        </div>
        <div style="color:red;"><?php if(isset($_SESSION['errmsg'])) { echo $_SESSION['errmsg']; $_SESSION['errmsg'] = ""; } ?></div>
        <div class="form-group">
          <button type="submit" name="submit" class="login-btn">Login</button>
        </div>
        <div class="form-group register-link">
          Don't have an account yet? <a href="registration.php">Create an account</a>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 BALAJI CLINIC HOSPITAL. All rights reserved.</p>
  </footer>

</body>
</html>
