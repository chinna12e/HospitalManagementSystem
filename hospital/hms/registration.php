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
    <meta charset="UTF-8">
    <title>Balaji | Patient Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { width: 400px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        .gender { margin: 10px 0; }
        .gender input { margin-right: 5px; }
        .agree { margin: 10px 0; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
        .login-link { display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Balaji | Patient Registration</h2>
        <?php if($msg) echo '<p class="success">'.$msg.'</p>'; ?>

        <form method="post" onsubmit="return validateForm();">
            <label>Full Name</label>
            <input type="text" name="full_name" required>

            <label>Address</label>
            <input type="text" name="address" required>

            <label>City</label>
            <input type="text" name="city" required>

            <label>Gender</label>
            <div class="gender">
                <input type="radio" name="gender" value="female" required> Female
                <input type="radio" name="gender" value="male" required> Male
            </div>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" id="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" id="password_again" name="password_again" required>

            <div class="agree">
                <input type="checkbox" checked disabled> I agree
            </div>

            <button type="submit" name="submit">Submit</button>
            <div class="login-link">
                Already have an account? <a href="user-login.php">Log-in</a>
            </div>
        </form>
    </div>

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
