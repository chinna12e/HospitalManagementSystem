<?php
session_start();
include("include/config.php");

if(isset($_POST['submit'])) {
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];

    $query = mysqli_query($con, "SELECT id FROM doctors WHERE contactno='$contactno' AND docEmail='$email'");
    $row = mysqli_num_rows($query);

    if($row > 0) {
        $_SESSION['cnumber'] = $contactno;
        $_SESSION['email'] = $email;
        header('Location: reset-password.php');
        exit();
    } else {
        $error = "Invalid details. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Password Recovery</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .container { width: 350px; margin: 100px auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; text-align: center; }
        .login-link { display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2> Doctor Password Recovery</h2>
        <form method="post">
            <input type="text" name="contactno" placeholder="Registered Contact Number" required>
            <input type="email" name="email" placeholder="Registered Email" required>
            <div class="error"><?php if(isset($error)) echo $error; ?></div>
            <button type="submit" name="submit">Reset</button>
            <a href="index.php" class="login-link">Already have an account? Log-in</a>
        </form>
    </div>
</body>
</html>
