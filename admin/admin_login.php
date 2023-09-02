<?php

# database
include("../inc/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];

    // Hash the password
    $password = hash('sha256', $password);

    // SQL query to check if the email and password match in the database
    $sql = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        // Login successful
        session_start();
        $adminData = $result->fetch_assoc();
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_id'] = $adminData['admin_id'];
        $_SESSION['admin_name'] = $adminData['admin_name'];
        header("Location: admin_panel.php"); 
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 

    <link rel="icon" type="image/x-icon" href="assets/img/admin_logo.jpg">
    <link rel="stylesheet" href="assets/css/admin_signup_login.css">

</head>
<body>

    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>

    <!-- Main Content -->
    <div class="container mt-5">
        <form method="POST" action="">
            <h2>Admin Login</h2>
            <div class="form-group">
                <label for="admin_email">Email:</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
            </div>

            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
            </div>
            <?php
            if (isset($loginError)) {
                echo "<p class='error' style='color: red; font-weight: bold;'>$loginError</p>";
            }
            ?>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="navbar navbar-expand-lg navbar-dark bg-primary footer" style="position: absolute; bottom: 0; width: 100%;">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-info text-center">
            <p style="font-weight: bold; margin: auto;">HappyHolidayHome
                <br>Made with ❤️ by Adhiraj Saha</p>
            <br>
            <p>Connect with me on:</p>
            <a href="https://www.linkedin.com/in/adhirajsaha" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-2x fa-linkedin" style="color: #ffffff;"></i>
            </a>
            &nbsp;
            <a href="https://github.com/adhirajcs" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-2x fa-github" style="color: #ffffff;"></i>
            </a>
        </div>
    </div>
</footer>


    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for theme toggle -->
    <script src="assets/js/admin_signup_login.js"></script>
    <script src="assets/js/header_footer.js"></script>
</body>
</html>
