<?php

# database
include("../inc/db.php");

if (isset($_POST['submit'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the admin_email already exists in the database
    $checkQuery = "SELECT * FROM admin WHERE admin_email = '$admin_email'";
    $result = $con->query($checkQuery);

    if ($result && $result->num_rows > 0) {
        $registrationError = "An account with the same email already exists.";
    } else {
        // Perform password validation and hashing
        if ($admin_password === $confirm_password && strlen($admin_password) > 7) {
            // Hash the password (you should use a strong hashing algorithm)
            $admin_password = hash('sha256', $admin_password);

            // SQL query to insert admin data into the database
            $sql = "INSERT INTO admin (admin_name, admin_email, admin_password) VALUES ('$admin_name', '$admin_email', '$admin_password')";

            // Execute the query using $con->query
            $insertResult = $con->query($sql);

            if ($insertResult) {
                // Registration successful
                $_SESSION['registrationSuccess'] = true;
                header("Location: admin_login.php");
                exit();
            } else {
                $registrationError = "Registration failed. Please try again.";
            }
        } else {
            $registrationError = "Passwords do not match or password length is less than 8.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Signup</title>

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
            <h2>Admin Signup</h2>
            <div class="form-group" style="text-align: left;">
                <label for="admin_name">Name:</label>
                <input type="text" class="form-control" id="admin_name" name="admin_name" required>
            </div>

            <div class="form-group" style="text-align: left;">
                <label for="admin_email">Email:</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
            </div>

            <div class="form-group" style="text-align: left;">
                <label for="admin_password">Password:</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
            </div>

            <div class="form-group" style="text-align: left;">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <?php
            if (isset($registrationError)) {
                echo "<p class='error' style='color: red; font-weight: bold;'>$registrationError</p>";
            }
            ?>
            <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
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