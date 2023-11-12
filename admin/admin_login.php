<?php

# database
include("../inc/db.php");
include("../inc/api.php");

if (isset($_POST['login'])) {
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];


    $secretKey = $sk;
    $resposnseKey = $_POST['g-recaptcha-response'];
    $UserIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$resposnseKey&remoteip=$UserIP";

    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {

        // Hash the password
        $password = hash('sha256', $password);

        // SQL query to check if the email and password match in the database
        $sql = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password = '$password'";
        $result = $con->query($sql);

        if ($result && $result->num_rows == 1) {
            // Login successful
            $adminData = $result->fetch_assoc();
            $_SESSION['admin_loggedin'] = true;
            $_SESSION['admin_id'] = $adminData['admin_id'];
            $_SESSION['admin_name'] = $adminData['admin_name'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Login failed
            $loginError = "Invalid email or password";
        }
    } else {
        $loginError = "Invalid Captcha! Please try again!!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/admin_signup_login.css">

</head>

<body>

    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>

    <!-- Main Content -->
    <div class="container mt-5">
        <form method="POST" action="" class="text-center">
            <h2>Admin Login</h2>
            <div class="form-group" style="text-align: left;">
                <label for="admin_email">Email:</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
            </div>

            <div class="form-group" style="text-align: left;">
                <label for="admin_password">Password:</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
            </div>
            <div class="d-grid gap-2">
                <div class="g-recaptcha mx-auto" data-sitekey="<?php echo $siteKey; ?>" style="margin-bottom: 20px;"></div>
            </div>
            <?php
            if (isset($loginError)) {
                echo "<p class='error' style='color: red; font-weight: bold;'>$loginError</p>";
            }
            ?>
            <div class="d-grid gap-2">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
                <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>


    <!-- Footer -->
    <?php include("inc/admin_footer.php"); ?>


    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for theme toggle -->
    <script src="assets/js/dark_mode.js"></script>
    <script src="assets/js/header_footer.js"></script>
</body>

</html>