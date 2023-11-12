<?php
# Include the database connection file
include("../inc/db.php");

# Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

# Initialize variables
$reservationId = $_POST['reservation_id']; // Get reservation_id from the form

# Retrieve form data (add more fields as needed)
$userId = $_POST["user_id"];
$homeId = $_POST["home_id"];
$checkInDate = $_POST["check_in_date"];
$checkOutDate = $_POST["check_out_date"];
$totalPrice = $_POST["total_price"];

# Update the reservation in the database using prepared statements
$updateQuery = "UPDATE reservations SET
    user_id = ?,
    home_id = ?,
    check_in_date = ?,
    check_out_date = ?,
    total_price = ?
    WHERE reservation_id = ?";

if ($stmt = $con->prepare($updateQuery)) {
    $stmt->bind_param("iissdi", $userId, $homeId, $checkInDate, $checkOutDate, $totalPrice, $reservationId);
    
    if ($stmt->execute()) {
        # Redirect back to view_reservations.php after updating
        header("Location: view_reservations.php");
        exit();
    } else {
        $editError = "Error updating reservation details: " . $stmt->error;
    }

    $stmt->close();
} else {
    $editError = "Error preparing the update statement: " . $con->error;
}
?>