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
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) === 1) {
        // Delete the reservation
        $deleteQuery = "DELETE FROM reservations WHERE reservation_id = $reservationId";
        $deleteResult = mysqli_query($conn, $deleteQuery);

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