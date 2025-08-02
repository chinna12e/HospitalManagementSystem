<?php
include_once('include/config.php');

$msg = '';
if(isset($_POST['submit'])) {
    $fname = $_POST['full_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($con, "INSERT INTO users(fullName,address,city,gender,email,password) 
        VALUES('$fname','$address','$city','$gender','$email','$password')");

    if($query) {
        $msg = "Successfully Registered! You can login now.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Patient Registration - Balaji Clinic Hospital</title>
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

  <!-- Registration Section -->
  <section class="login-section">
    <div class="login-container">
        <h2>Patient Registration</h2>
        <?php if($msg) echo '<p style="color:green; text-align:center;">'.$msg.'</p>'; ?>

        <form method="post" onsubmit="return validateForm();">
            <div class="form-group">
                <input type="text" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <input type="text" name="city" placeholder="City" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <input type="radio" name="gender" value="female" required> Female
                    <input type="radio" name="gender" value="male" required> Male
                </div>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" id="password_again" name="password_again" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="login-btn">Submit</button>
            </div>
            <div class="form-group register-link">
                Already have an account? <a href="login.php">Log-in</a>
            </div>
        </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 BALAJI CLINIC HOSPITAL. All rights reserved.</p>
  </footer>

<script>
function validateForm() {
    var pass = document.getElementById('password').value;
    var confirm = document.getElementById('password_again').value;
    if(pass !== confirm) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}
</script>
</body>
</html>
