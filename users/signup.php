<?php

# database
include("../inc/db.php");
include("../inc/api.php");

// Include PHPMailer
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if(strlen($phone)==10) {

    // Check if the email or phone number already exists in the database
    $checkQuery = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $result = $con->query($checkQuery);

    if ($result->num_rows > 0) {
        $registrationError = "An account with the same email or phone number already exists.";
    } else {
        // Perform password validation and hashing
        if ($password === $confirmPassword && strlen($password) > 7) {
            $password = hash('sha256', $password);

            $otp = rand(100000, 999999);

            // Store OTP in the database
            $insertOtp = "INSERT INTO otp (user_email, otp_code, timestamp) VALUES ('$email', $otp, NOW())";
            $con->query($insertOtp);

            // Send OTP via email
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'adhirajfirst@gmail.com';
            $mail->Password = $app_password;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('adhirajfirst@gmail.com', 'HappyHolidayHome');
            $mail->addAddress($email);

            $mail->Subject = 'Your OTP for Login';
            $mail->Body = "Your OTP is: $otp";

            if ($mail->send()) {
                // Redirect to verify_otp.php with email and name parameter
                header("Location: verify_otp.php?email=$email&name=$name&phone=$phone&password=$password");
                exit();
            } else {
                $registrationError = "Failed to send OTP. Please try again later.";
            }
        } else {
            $registrationError = "Passwords do not match or password length is less than 8.";
        }
    }

}else {
    $registrationError = "Phone number should be of 10 digits.";
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
