<?php

# database
include("../inc/db.php");

// Check if the admin is logged in, if not, redirect to the login page
if (!isset($_SESSION['admin_id']) || !$_SESSION['admin_id']) {
    header("Location: admin_login.php");
    exit();
}

// Retrieve admin data from the database based on the admin ID stored in the session
$adminID = $_SESSION['admin_id'];

// Perform a database query to get the admin's information
$sql = "SELECT * FROM admin WHERE admin_id = $adminID";
$result = $con->query($sql);

if ($result->num_rows == 1) {
    $adminData = $result->fetch_assoc();
    $adminName = $adminData['admin_name'];
    $adminEmail = $adminData['admin_email'];
} else {
    // Handle the case where the admin data couldn't be retrieved
    echo "Error: Admin data not found.";
    exit();
}

// Check if the admin submitted a password change request
if (isset($_POST['changePassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Check if the current password matches the stored password
    $storedPassword = $adminData['admin_password'];

    if (hash('sha256', $currentPassword) === $storedPassword) {
        // Current password matches the stored password
        if ($newPassword !== $currentPassword) {
            // Ensure the new password is not the same as the current password
            if ($newPassword === $confirmNewPassword) {
                // New password and confirm new password match
                // Update the admin's password in the database using SHA-256
                $hashedNewPassword = hash('sha256', $newPassword);
                $updateSql = "UPDATE admin SET admin_password = '$hashedNewPassword' WHERE admin_id = $adminID";
                if ($con->query($updateSql)) {
                    // Password updated successfully
                    $passwordChangeSuccess = "Password updated successfully.";
                } else {
                    $passwordChangeError = "Password update failed. Please try again.";
                }
            } else {
                $passwordChangeError = "New password and confirm new password do not match.";
            }
        } else {
            $passwordChangeError = "The new password is the same as the current password.";
        }
    } else {
        $passwordChangeError = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Profile</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/admin_profile.css">

</head>

<body>

    <!-- Header -->
    <?php include("inc/admin_header.php"); ?>

    <div class="container mt-5">
        <h1>Welcome, <?php echo $adminName; ?></h1>
        <p>Email: <?php echo $adminEmail; ?></p>

        <!-- Change Password Form -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Change Password</h2>
                <?php
                if (isset($passwordChangeSuccess)) {
                    echo "<p style='color: green;'>$passwordChangeSuccess</p>";
                } elseif (isset($passwordChangeError)) {
                    echo "<p style='color: red;'>$passwordChangeError</p>";
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password:</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirm New Password:</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                    </div>
                    <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
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