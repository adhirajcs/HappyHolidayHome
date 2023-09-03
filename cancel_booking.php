<?php

# database
include("inc/db.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['cancel_booking'])) {
    $reservationId = $_POST['reservation_id'];
    $userId = $_SESSION['user_id'];

    // Check if the reservation belongs to the logged-in user
    $checkQuery = "SELECT * FROM reservations WHERE reservation_id = $reservationId AND user_id = $userId";
    $checkResult = $con->query($checkQuery);

    if ($checkResult && $checkResult->num_rows === 1) {
        // Delete the reservation
        $deleteQuery = "DELETE FROM reservations WHERE reservation_id = $reservationId";
        $deleteResult = $con->query($deleteQuery);

        if ($deleteResult) {
            header("Location: reservations.php");
        } else {
            echo "Error canceling booking.";
        }
    } else {
        echo "Invalid reservation.";
    }
} else {
    header("Location: reservations.php");
}
?>