<?php
# database
include("../inc/db.php");

if (isset($_GET['email']) && isset($_GET['name']) && isset($_GET['phone']) && isset($_GET['password'])) {
    $email = $_GET['email'];
    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $password = $_GET['password'];


    if (isset($_POST['verify'])) {
        $enteredOtp = $_POST['otp'];
        $sql = "SELECT * FROM otp WHERE user_email = '$email' AND otp_code = $enteredOtp";
        $otpResult = $con->query($sql);

        if ($otpResult->num_rows == 1) {
            // Delete OTP record
            $deleteOtp = "DELETE FROM otp WHERE user_email = '$email'";
            $con->query($deleteOtp);

            $insertQuery = "INSERT INTO users (name, email, phone, password) 
                            VALUES ('$name', '$email', '$phone', '$password')";

            if ($con->query($insertQuery)) {
                // Registration successful
                $_SESSION['registrationSuccess'] = true;
                header("Location: login.php");
                exit();
        } else {
            $verifyError = "Invalid OTP. Please try again.";
        }
    }
} 
}
else {
    $missingEmailError = "Missing email or name parameter. Please provide a valid email link.";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Verify OTP - HappyHolidayHome</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="../assets/css/signup-login.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    
</head>
<body>

    <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>

    <div class="container">
        <?php if (isset($missingEmailError)) : ?>
            <p class="error" style="color: red; font-weight: bold;"><?php echo $missingEmailError; ?></p>
        <?php else : ?>
            <form action="" method="POST" class="form">
                <label>Enter OTP sent to your email:</label>
                <input type="text" name="otp" required>
                <?php
                if (isset($verifyError)) {
                    echo "<p class='error' style='color: red; font-weight: bold;'>$verifyError</p>";
                }
                ?>
                <button type="submit" name="verify" class="btn btn-success">Verify OTP</button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>

</body>
</html>
