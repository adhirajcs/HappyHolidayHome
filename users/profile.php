<?php
// Include your database connection code here
include("../inc/db.php");

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit();
}

// Retrieve user data from the database based on the user ID stored in the session
$userID = $_SESSION['user_id'];

// Perform a database query to get the user's information
$sql = "SELECT * FROM users WHERE user_id = $userID";
$result = $con->query($sql);

if ($result->num_rows == 1) {
    $userData = $result->fetch_assoc();
    $userName = $userData['name'];
    $userEmail = $userData['email'];
    $userPhone = $userData['phone'];
} else {
    // Handle the case where the user data couldn't be retrieved
    echo "Error: User data not found.";
    exit();
}

// Check if the user submitted a password change request
if (isset($_POST['changePassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Check if the current password matches the stored password using SHA-256
    $storedPassword = $userData['password'];

    if (hash('sha256', $currentPassword) === $storedPassword) {
        // Current password matches the stored password
        if ($newPassword !== $currentPassword) {
            // Ensure the new password is not the same as the current password
            if ($newPassword === $confirmNewPassword) {
                // New password and confirm new password match
                // Update the user's password in the database using SHA-256
                $hashedNewPassword = hash('sha256', $newPassword);
                $updateSql = "UPDATE users SET password = '$hashedNewPassword' WHERE user_id = $userID";
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
    <title>HappyHolidayHome - My Profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>

<body>

    <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>

    <div class="container">
        <fieldset class="profile-fieldset">
            <legend>My Profile</legend>
            <div class="user-data">
                <div class="user-info">
                    <h1>Welcome, <?php echo $userName; ?></h1>
                    <p>Email: <br><?php echo $userEmail; ?></p>
                    <p>Phone: <br><?php echo $userPhone; ?></p>
                </div>
                <div class="password-change">
                    <h2>Change Password</h2>
                    <?php
                    if (isset($passwordChangeSuccess)) {
                        echo "<p style='color: #00E746; font-weight: bold; '>$passwordChangeSuccess</p>";
                    } elseif (isset($passwordChangeError)) {
                        echo "<p style='color: #FF0000; font-weight: bold;'>$passwordChangeError</p>";
                    }
                    ?>
                    <form action="" method="POST">
                        <label>Current Password:</label>
                        <input type="password" name="currentPassword" required>
                        <label>New Password:</label>
                        <input type="password" name="newPassword" required>
                        <label>Confirm New Password:</label>
                        <input type="password" name="confirmNewPassword" required>
                        <button type="submit" name="changePassword">Change Password</button>
                    </form>
                </div>
            </div>
        </fieldset>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>

</body>

</html>
