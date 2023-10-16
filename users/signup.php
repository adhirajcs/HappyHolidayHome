<?php

# database
include("../inc/db.php");

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the email or phone number already exists in the database
    $checkQuery = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $result = $con->query($checkQuery);

    if ($result->num_rows > 0) {
        $registrationError = "An account with the same email or phone number already exists.";
    } else {
        // Perform password validation and hashing
        if ($password === $confirmPassword) {
            $password = hash('sha256', $password);

            $insertQuery = "INSERT INTO users (name, email, phone, password) 
                            VALUES ('$name', '$email', '$phone', '$password')";

            if ($con->query($insertQuery)) {
                // Registration successful
                $_SESSION['registrationSuccess'] = true;
                header("Location: login.php");
                exit();
            } else {
                $registrationError = "Registration failed. Please try again.";
            }
        } else {
            $registrationError = "Passwords do not match.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HappyHolidayHome - Sign Up</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="../assets/css/signup-login.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    
</head>

<body">
     
     <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>
    <br><br><br>

    <div class="container">
        <form action="" method="POST" class="form">
            <label>Enter your Name:</label>
            <input type="text" id="name" name="name" placeholder="Your Full Name" required>
            <label>Enter your Email ID:</label>
            <input type="email" id="email" name="email" placeholder="username@abc.com" required>
            <label>Enter your Phone number:</label>
            <input type="tel" id="phone" name="phone" placeholder="0123456789" pattern="[0-9]{10}" required>
            <label>Enter your Password:</label>
            <input type="password" id="password" name="password" required>
            <label>Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <?php
            if (isset($registrationError)) {
                echo "<p class='error' style='color: red; font-weight: bold;'>$registrationError</p>";
            }
            ?>
            <button type="submit" name="save" class="btn btn-success">Sign Up</button>
            <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
            <p class="no-account">Already have Account? <a href="login.php">Login here</a></p>
            <p class="no-account">Are you an Admin? <a href="../admin/admin_signup.php">Admin Sign Up</a></p>
        </form>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>
</body>

</html>