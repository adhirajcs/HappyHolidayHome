<?php

# database
include("inc/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    #$hashedPassword = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $rs = $conn->query($sql);

    if ($rs->num_rows == 1) {
        // Login successful
        session_start();
        $_SESSION['loggedin'] = true;
        
        header("Location: index.php");
        exit();
    } else {
        // Login failed
        $loginError = "Invalid email or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHolidayHome - Login</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/signup-login.css">
    
</head>

<body>

    <!-- Nav Bar -->
    <?php include("inc/header.php"); ?>

    <div class="container">
        <form action="" method="POST" class="form">
            <label>Enter your Email ID:</label>
            <input type="email" id="loginEmail" name="loginEmail" placeholder="username@abc.com" required>
            <label>Enter your Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>
            <?php
            if (isset($loginError)) {
                echo "<p class='error' style='color: red; font-weight: bold;'>$loginError</p>";
            }
            ?>
            <button type="submit" name="login" class="btn btn-success">Login</button>
            <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
            <p class="no-account">Don't have an account? <a href="signup.php">Sign up here</a></p>
        </form>


    </div>
    
    <!-- Footer -->
    <?php include("inc/footer.php"); ?>
</body>

</html>
